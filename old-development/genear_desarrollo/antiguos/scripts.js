// scripts.js
document.addEventListener('DOMContentLoaded', function() {
    cargarPersonas();
});

function cargarPersonas() {
    fetch('cargar_personas.php')
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('persona-select');
            data.forEach(persona => {
                const option = document.createElement('option');
                option.value = persona.PersonaID;
                option.textContent = `${persona.Nombre} ${persona.Apellido_Paterno} ${persona.Apellido_Materno}`;
                select.appendChild(option);
            });
        });
}

function cargarDatosPersona() {
    const personaID = document.getElementById('persona-select').value;
    fetch(`cargar_datos_persona.php?PersonaID=${personaID}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('nombre').textContent = data.Nombre;
            document.getElementById('apellido_paterno').textContent = data.Apellido_Paterno;
            document.getElementById('apellido_materno').textContent = data.Apellido_Materno;
            document.getElementById('fecha_nacimiento').textContent = data.Fecha_de_Nacimiento;
            document.getElementById('fecha_defuncion').textContent = data.Fecha_de_Defunción;
            document.getElementById('padre').textContent = data.Padre;
            document.getElementById('madre').textContent = data.Madre;
            cargarHermanos(personaID);
            cargarHijos(personaID);
            cargarParejas(personaID);

         //   document.getElementById('genero').textContent = data.Genero;
            document.getElementById('foto').textContent = data.Foto;
   
// Insertado para Foto
            let fotoSrc = data.Foto;
            if (!fotoSrc) {
                fotoSrc = data.Genero === 'M' ? 'Genealorico/fotos/hombre.jpg' : 'Genealorico/fotos/mujer.jpg';
            }
             document.getElementById('foto').src = fotoSrc;
// Fin insercion foto

        });
}

function cargarFotoporDefecto() {
    let fotoSrc = data.Foto;
    if (!fotoSrc) {
        fotoSrc =  'Genealorico/fotos/hombre.jpg';
    }
        
}

function cargarHermanos(personaID) {
    fetch(`cargar_hermanos.php?PersonaID=${personaID}`)
        .then(response => response.json())
        .then(data => {
            const lista = document.getElementById('lista-hermanos');
            lista.innerHTML = '';
            data.forEach(hermano => {
                const li = document.createElement('li');
                li.textContent = `${hermano.Nombre} ${hermano.Apellido_Paterno} ${hermano.Apellido_Materno}`;
                lista.appendChild(li);
            });
        });
}

function cargarHijos(personaID) {
    fetch(`cargar_hijos.php?PersonaID=${personaID}`)
        .then(response => response.json())
        .then(data => {
            const lista = document.getElementById('lista-hijos');
            lista.innerHTML = '';
            data.forEach(hijo => {
                const li = document.createElement('li');
                li.textContent = `${hijo.Nombre} ${hijo.Apellido_Paterno} ${hijo.Apellido_Materno}`;
                lista.appendChild(li);
            });
        });
}

function cargarParejas(personaID) {
    fetch(`cargar_parejas.php?PersonaID=${personaID}`)
        .then(response => response.json())
        .then(data => {
            const lista = document.getElementById('lista-parejas');
            lista.innerHTML = '';
            data.forEach(pareja => {
                const li = document.createElement('li');
                li.textContent = `${pareja.Nombre} ${pareja.Apellido_Paterno} ${pareja.Apellido_Materno}`;
                lista.appendChild(li);
            });
        });
}
