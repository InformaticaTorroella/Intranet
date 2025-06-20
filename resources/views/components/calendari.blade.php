@php
    use Carbon\Carbon;
    $currentYear = $year ?? now()->year;
    $currentMonth = $month ?? now()->month;
    $todayDay = now()->day;

    $date = Carbon::create($currentYear, $currentMonth, 1);
    $startWeekDay = $date->isoFormat('E');
    $daysInMonth = $date->daysInMonth;
    $monthName = $date->locale('ca')->monthName;
    $totalCells = 42;
@endphp

<div id="calendar" class="calendar-container">
    <div class="calendar-header">
        <button id="prevMonth" aria-label="Mes anterior">&lt;</button>
        <span id="monthYear">{{ $monthName }} {{ $currentYear }}</span>
        <button id="nextMonth" aria-label="Mes següent">&gt;</button>
    </div>
    <div class="calendar-grid">
        @foreach (['Dl', 'Dt', 'Dc', 'Dj', 'Dv', 'Ds', 'Dg'] as $day)
            <div class="calendar-day-name">{{ $day }}</div>
        @endforeach

        @for ($i = 1; $i < $startWeekDay; $i++)
            <div class="calendar-day empty"></div>
        @endfor

        @for ($day = 1; $day <= $daysInMonth; $day++)
            @php
                $isToday = $currentYear == now()->year && $currentMonth == now()->month && $day == $todayDay;
            @endphp
            <div class="calendar-day {{ $isToday ? 'today' : '' }}">{{ $day }}</div>
        @endfor

        @php
            $filledCells = $daysInMonth + $startWeekDay - 1;
            $remaining = $totalCells - $filledCells;
        @endphp
        @for ($i = 0; $i < $remaining; $i++)
            <div class="calendar-day empty"></div>
        @endfor
    </div>
</div>

<style>

</style>

<script>
(() => {
    const calendarEl = document.getElementById('calendar');
    let currentYear = {{ $currentYear }};
    let currentMonth = {{ $currentMonth }};
    const todayDate = new Date();
    const todayYear = todayDate.getFullYear();
    const todayMonth = todayDate.getMonth() + 1;
    const todayDay = todayDate.getDate();

    const monthYearEl = calendarEl.querySelector('#monthYear');
    const gridEl = calendarEl.querySelector('.calendar-grid');

    const dayNames = ['Dl', 'Dt', 'Dc', 'Dj', 'Dv', 'Ds', 'Dg'];

    function generateCalendar(year, month) {
        const date = new Date(year, month - 1, 1);
        const startWeekDay = (date.getDay() === 0) ? 7 : date.getDay();
        const daysInMonth = new Date(year, month, 0).getDate();
        const totalCells = 42;

        const monthsCa = ['gener', 'febrer', 'març', 'abril', 'maig', 'juny', 'juliol', 'agost', 'setembre', 'octubre', 'novembre', 'desembre'];

        monthYearEl.textContent = monthsCa[month - 1] + ' ' + year;

        let html = '';
        for (let d = 0; d < dayNames.length; d++) {
            html += `<div class="calendar-day-name">${dayNames[d]}</div>`;
        }

        for (let i = 1; i < startWeekDay; i++) {
            html += `<div class="calendar-day empty"></div>`;
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const isToday = year === todayYear && month === todayMonth && day === todayDay;
            html += `<div class="calendar-day${isToday ? ' today' : ''}">${day}</div>`;
        }

        const filledCells = daysInMonth + startWeekDay - 1;
        const remaining = totalCells - filledCells;
        for (let i = 0; i < remaining; i++) {
            html += `<div class="calendar-day empty"></div>`;
        }

        gridEl.innerHTML = html;
    }

    document.getElementById('prevMonth').addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 1) {
            currentMonth = 12;
            currentYear--;
        }
        generateCalendar(currentYear, currentMonth);
    });

    document.getElementById('nextMonth').addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 12) {
            currentMonth = 1;
            currentYear++;
        }
        generateCalendar(currentYear, currentMonth);
    });

    generateCalendar(currentYear, currentMonth);
})();
</script>
