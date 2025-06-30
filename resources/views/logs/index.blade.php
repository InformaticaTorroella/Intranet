<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="{{ asset('images/Escut_Transparent.png') }}" type="image/png">
    <title>Intranet de Torroella de Montgrí</title>
    <link rel="stylesheet" href="{{ asset('css/logs.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <x-header />
    @php
        $userGroups = session('user_groups', []);
        $allowedGroups = ['Intranet_Informatica', 'Admin'];
    @endphp
    @if(session()->has('username') && in_array($allowedGroups, $userGroups))
        <main class="logs-container">
            <h1 class="logs-title">Logs d'Activitat</h1>

            <table class="logs-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuari</th>
                        <th>Acció</th>
                        <th>Objectiu</th>
                        <th>IP</th>
                        <th>Detalls</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>{{ $log->username }}</td>
                            <td>{{ $log->action }}</td>
                            <td>{{ $log->target ?? '-' }}</td>
                            <td>{{ $log->ip_address ?? '-' }}</td>
                            <td>{{ $log->details ?? '-' }}</td>
                            <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="logs-empty">No hi ha logs disponibles.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="pagination">
                {{ $logs->links() }}
            </div>

        </main>
    @else
        <div class="no-access" style="text-align: center;">
            <h1>No teniu permisos per accedir a aquesta pàgina.</h1>
            <p>Si us plau, contacteu amb el seu administrador.</p>
        </div>
    @endif
    <x-footer />
</body>
</html>
