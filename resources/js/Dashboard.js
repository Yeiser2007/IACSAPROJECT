      // Gráfico de empleados por categoría
      const ctx1 = document.getElementById('empleadosPorCategoria').getContext('2d');
      const empleadosPorCategoriaChart = new Chart(ctx1, {
        type: 'bar',
        data: {
          labels: ['Categoría 1', 'Categoría 2', 'Categoría 3'],
          datasets: [
            {
              label: 'Empleados por Categoría',
              data: [50, 80, 70],
              backgroundColor: ['#007bff', '#28a745', '#dc3545'],
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
        },
      });

      // Gráfico de empleados activos e inactivos
      const ctx2 = document.getElementById('empleadosActivosInactivos').getContext('2d');
      const empleadosActivosInactivosChart = new Chart(ctx2, {
        type: 'pie',
        data: {
          labels: ['Activos', 'Inactivos'],
          datasets: [
            {
              label: 'Empleados Activos vs Inactivos',
              data: [180, 20],
              backgroundColor: ['#28a745', '#dc3545'],
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
        },
      });