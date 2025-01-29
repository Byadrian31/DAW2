document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modal');

    const titulo = document.getElementById('titulo');
    const pronostico = document.getElementById('pronostico');
    const camara = document.getElementById('skycam');
    
    document.querySelectorAll('area').forEach(zona => {
        zona.addEventListener('click', async (event) => {
            event.preventDefault();
            titulo.innerHTML = "";
            modal.style.display = 'block';
            document.body.style.backgroundColor = 'rgba(0,0,0,0.5)';
            var lat = zona.getAttribute('data-lat');
            var long = zona.getAttribute('data-lon');
            ntitulo = "  <b> <i>" + zona.getAttribute('title') + "</i></b>";
            titulo.innerHTML = ntitulo;

            const response = await fetch(`https://api.weatherusa.net/v1/forecast?q=${lat},${long}&daily=0&units=e&maxtime=1d`); // URL de la API
            console.log(response);
            const data = await response.json(); // Convertir la respuesta a JSON
            pronostico.innerHTML = ""; // Limpiar la tabla
            
            data.forEach(element => {
                var dia = element.localtime;
                var temp = ((element.temp-32) * 5 / 9).toFixed(1) //Convertir a grados centígrados;
                var viento = element.wdir_compass;
                var velViento = element.wspd;
                var cond = element.wx_str
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${dia}</td>
                    <td>${temp}</td>
                    <td>${viento}</td>
                    <td>${velViento}</td>
                    <td>${cond}</td>
                `;
                pronostico.appendChild(row);
            });

            const img = await fetch(`https://api.weatherusa.net/v1/skycams?q=${lat},${long}`); // URL de la API
            const imgData = await img.json(); // Convertir la respuesta a JSON
            camara.src = imgData[0].image;
            camara.style.maxWidth = '100%';

        });

        document.getElementById('cerrarModal').addEventListener('click', () => {
            modal.style.display = 'none';
            document.body.style.backgroundColor = 'white';
        });
    });
});

