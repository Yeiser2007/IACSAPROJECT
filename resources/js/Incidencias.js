function calculateExtras() {
    const horario = document.getElementById('horario').value.split('-');
    const inicioHorario = horario[0];
    const finHorario = horario[1];

    const inicio = document.getElementById('inicio').value;
    const fin = document.getElementById('fin').value;

    if (inicio && fin) {
        const [startHour, startMinute] = inicio.split(':').map(Number);
        const [endHour, endMinute] = fin.split(':').map(Number);
        const [workStartHour, workStartMinute] = inicioHorario.split(':').map(Number);
        const [workEndHour, workEndMinute] = finHorario.split(':').map(Number);

        const startTime = new Date();
        const endTime = new Date();
        const workStartTime = new Date();
        const workEndTime = new Date();

        startTime.setHours(startHour, startMinute);
        endTime.setHours(endHour, endMinute);
        workStartTime.setHours(workStartHour, workStartMinute);
        workEndTime.setHours(workEndHour, workEndMinute);

        let extraHours = 0;
        if (startTime < workStartTime) {
            extraHours += (workStartTime - startTime) / (1000 * 60 * 60);
        }
        if (endTime > workEndTime) {
            extraHours += (endTime - workEndTime) / (1000 * 60 * 60);
        }

        document.getElementById('extras').value = extraHours.toFixed(2);
    }
}

function getWeekInfo() {
    const week = document.getElementById('semana-actual');
    const startDayWeek = document.getElementById('dia-inicio');
    const endDayWeek = document.getElementById('dia-fin');
    const monthWeek = document.getElementById('mes');
    const anioWeek = document.getElementById('anio');
    const today = new Date();
    const year = today.getFullYear();
    const month = today.getMonth() + 1; 

    const startOfWeek = new Date(today);
    const dayOfWeek = today.getDay();
    const daysUntilThursday = (4 - dayOfWeek + 7) % 7;
    startOfWeek.setDate(today.getDate() + daysUntilThursday);
    const endOfWeek = new Date(startOfWeek);
    endOfWeek.setDate(startOfWeek.getDate() + 6);

    const startDay = startOfWeek.toISOString().split('T')[0];
    const endDay = endOfWeek.toISOString().split('T')[0];
    const firstDayOfYear = new Date(today.getFullYear(), 0, 1);
    const pastDaysOfYear = (today - firstDayOfYear + (firstDayOfYear.getTimezoneOffset() - today.getTimezoneOffset()) * 60000) / 86400000;
    const weekNumber = Math.ceil((pastDaysOfYear + firstDayOfYear.getDay() + 1) / 7);

    console.log(`Semana actual: ${weekNumber}`);
    console.log(`Empieza el: ${startDay}`);
    console.log(`Termina el: ${endDay}`);
    console.log(`Mes: ${month}`);
    console.log(`Año: ${year}`);
    week.textContent=weekNumber;
    startDayWeek.innerHTML = `Empieza el ${startDay}`;
    endDayWeek.innerHTML = `Termina el ${endDay}`;
    monthWeek.innerHTML = `Mes ${month}`;
    anioWeek.innerHTML = `Año ${year}`;

    return { weekNumber, startDay, endDay, month, year };
}
function filterTable() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const table = document.querySelector('.table tbody');
    const rows = table.getElementsByTagName('tr');
    for (let i = 0; i < rows.length; i++) {
        const td = rows[i].getElementsByTagName('td')[0];
        if (td) {
            const textValue = td.textContent || td.innerText;
            // Mostrar u ocultar la fila según el valor de búsqueda
            rows[i].style.display = textValue.toLowerCase().includes(filter) ? '' : 'none';
        }
    }
}
getWeekInfo();

document.addEventListener("DOMContentLoaded", function () {
    


})
