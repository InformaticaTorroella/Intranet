<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // formulari login
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        $ldapConfig = config('ldap.connections.default');

        $ldapServer = "ldap://" . $ldapConfig['hosts'][0];
        $ldapConn = ldap_connect($ldapServer, $ldapConfig['port']);

        if (!$ldapConn) {
            return back()->withErrors(['ldap' => 'No se pudo conectar al servidor LDAP']);
        }

        ldap_set_option($ldapConn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldapConn, LDAP_OPT_REFERRALS, 0);

        $domain = env('LDAP_USER_DOMAIN', 'torroella.local');
        $ldapUser = $username . '@' . $domain;

        $bind = @ldap_bind($ldapConn, $ldapUser, $password);

        if (!$bind) {
            return back()->withErrors(['credentials' => 'Credenciales incorrectas']);
        }

        $baseDn = $ldapConfig['base_dn'];
        $filter = "(sAMAccountName=$username)";
        $search = ldap_search($ldapConn, $baseDn, $filter);

        if (!$search) {
            ldap_unbind($ldapConn);
            return back()->withErrors(['ldap' => 'Error en la búsqueda LDAP']);
        }

        $entries = ldap_get_entries($ldapConn, $search);
        ldap_unbind($ldapConn);

        if ($entries['count'] == 0) {
            return back()->withErrors(['ldap' => 'Usuario no encontrado en LDAP']);
        }

        $userInfo = $entries[0];

        // Intenta extreure l'OU
        $ou = $userInfo['ou'][0] ?? (
            (preg_match('/OU=([^,]+)/', $userInfo['distinguishedname'][0] ?? '', $m)) ? $m[1] : 'Desconegut'
        );

        session([
            'username' => $username,
            'name' => trim(($userInfo['givenname'][0] ?? '') . ' ' . ($userInfo['sn'][0] ?? '')),
            'ou' => $ou,
        ]);


        return redirect('/admin/home');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $intendedUrl = session('url.intended', '/admin/home'); // Si no hi ha, home por defecte
        session()->forget('url.intended'); // netejar la URL

        return redirect($intendedUrl);
    }


}
