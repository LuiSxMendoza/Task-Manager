(function() {
    //? Boton para mostrar modal de agg tarea
    const nuevaTareaBtn = document.querySelector('#agg-tarea');
    nuevaTareaBtn.addEventListener('click', function() {
        mostrarForm();
    });

    //! Crea formulario flotante
    function mostrarForm(editar = false, tarea = {}) {
        const modal = document.createElement('DIV');
        modal.classList.add('modal');
        modal.innerHTML = `
        <form class="formulario nueva-tarea">
            <legend>${editar ? 'Editar Tarea' : 'Añade una nueva tarea'}</legend>
            <div class="campo-mod">
                <label>Tarea:</label>
                <input
                    type="text"
                    name="tarea"
                    placeholder="${tarea.nombre ? 'Editar Tarea' : 'Añadir Tarea al Proyecto actual'}"
                    id="tarea"
                    value="${tarea.nombre ? tarea.nombre : ''}"
                />
            </div>
            <div class="opciones">
                <input
                    type="submit"
                    class="submit-nueva-tarea"
                    value="${tarea.nombre ? 'Actualizar' : 'Añadir Tarea'}"
                />
                <button type="button" class="cerrar-modal">Cancelar</button>
            </div>
        </form>
        `;

        setTimeout(() => {
            document.querySelector('.formulario').classList.add('animar');
        }, 0);

        modal.addEventListener('click', function(e) {
            e.preventDefault();
            if(e.target.classList.contains('cerrar-modal')) {
                document.querySelector('.formulario').classList.add('cerrar');
                setTimeout(() => {
                    modal.remove();
                }, 800);
            }
            if (e.target.classList.contains('submit-nueva-tarea')) {

                const nombreTarea = document.querySelector('#tarea').value.trim();
                //console.log(tarea);

                if (nombreTarea === '') {
                    mostrarAlerta('Debes añadir un nombre a la tarea', 'error', 
                    document.querySelector('.formulario legend'));
                    return;
                } 

                if (editar) {
                    tarea.nombre = nombreTarea;
                    actualizarTarea(tarea);
                } else {
                    agregarTarea(nombreTarea);
                }
            }
        });

        document.querySelector('.dashboard').appendChild(modal);
    }

    //? Muestra msj en la interfaz
    function mostrarAlerta (mensaje, tipo, referencia) {
        //? Prevenir multiples alertas
        const alertaPrevia = document.querySelector('.alerta');
        if (alertaPrevia) {
            alertaPrevia.remove();
        }

        const alerta = document.createElement('DIV');
        alerta.classList.add('alerta', tipo);
        alerta.textContent = mensaje;

        //? Inserta alerta despues del legend
        referencia.parentElement.insertBefore(alerta, referencia.nextElementSibling);

        //? Eliminar alerta 
        setTimeout(() => {
            alerta.remove();
        }, 3500);
    }

    //! Consultar API de tareas
    obtenerTareas();
    let tareas = [];
    let filtradas = [];

    async function obtenerTareas() {
        try {
            const id = obtenerProyecto();
            const url = `/api/tareas?url=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            tareas = resultado.tareas;
            mostrarTareas();

        } catch (error) {
            console.log(error);
        }
    }

    //! Mostrar tareas en layout
    function mostrarTareas() {
        limpiarTareas();
        totalPendientes();
        totalCompletos();

        const arrayTareas = filtradas.length ? filtradas : tareas;

        if (arrayTareas.length === 0) {
            const contTareas = document.querySelector('#listado-tareas');

            const textoNoTareas = document.createElement('LI');
            textoNoTareas.textContent = 'No Hay Tareas Para Mostrar :(';
            textoNoTareas.classList.add('no-tareas');

            contTareas.appendChild(textoNoTareas);
            return;
        }

        const estados = {
            0: 'Pendiente',
            1: 'Completado'
        }

        arrayTareas.forEach(tarea => {
            const contTarea = document.createElement('LI');
            contTarea.dataset.tareaId = tarea.id;
            contTarea.classList.add('tarea');

            const nombreTarea = document.createElement('P');
            nombreTarea.textContent = tarea.nombre;
            nombreTarea.classList.add('tarea-nombre');
            nombreTarea.ondblclick = function() {
                mostrarForm(editar = true, {...tarea});
            }

            const opcionesDiv = document.createElement('DIV');
            opcionesDiv.classList.add('opciones');

            //? Botones
            const btnEstadoTarea = document.createElement('BUTTON');
            btnEstadoTarea.classList.add('estado-tarea');
            btnEstadoTarea.classList.add(`${estados[tarea.estado].toLowerCase()}`)
            btnEstadoTarea.textContent = estados[tarea.estado];
            btnEstadoTarea.dataset.estadoTarea = tarea.estado;
            btnEstadoTarea.ondblclick = function() {
                cambiarEstadoTarea({...tarea});
            }
            
            const btnEliminarTarea = document.createElement('BUTTON');
            btnEliminarTarea.classList.add('eliminar-tarea');
            btnEliminarTarea.dataset.idTarea = tarea.id;
            btnEliminarTarea.textContent = 'Eliminar';
            btnEliminarTarea.ondblclick = function() {
                confirmarEliminarTarea({...tarea});
            }

            opcionesDiv.appendChild(btnEstadoTarea);
            opcionesDiv.appendChild(btnEliminarTarea);

            contTarea.appendChild(nombreTarea);
            contTarea.appendChild(opcionesDiv);

            const listadoTareas = document.querySelector('#listado-tareas');
            listadoTareas.appendChild(contTarea);
        });
        
    }

    //? Filtros de busqueda
    const filtros = document.querySelectorAll('#filtros input[type="radio"]');
    filtros.forEach( radio => {
        radio.addEventListener('input', filtrarTareas);
    });

    function filtrarTareas(e) {
        const filtro = e.target.value;

        if (filtro !== '') {
            filtradas = tareas.filter(tarea => tarea.estado === filtro);
        } else {
            filtradas = [];
        }
        mostrarTareas();
    }

    //? Deshabilitar input de pendientes si no hay
    function totalPendientes() {
        const totalPendientes = tareas.filter(tarea => tarea.estado === "0");
        const pendientesInput = document.querySelector('#pendientes');

        if(totalPendientes.length === 0) {
            pendientesInput.disabled = true;
        } else {
            pendientesInput.disabled = false;
        }
    }

    //? Deshabilitar input de completos si no hay
    function totalCompletos() {
        const totalCompletos = tareas.filter(tarea => tarea.estado === "1");
        const completadosInput = document.querySelector('#completadas');

        if(totalCompletos.length === 0) {
            completadosInput.disabled = true;
        } else {
            completadosInput.disabled = false;
        }
    }

    //! Consultar servidor para añadir tarea al proyecto
    async function agregarTarea(tarea) {
        //? Construir la peticion
        const datos = new FormData();
        datos.append('nombre', tarea);
        datos.append('proyectoId', obtenerProyecto());

        try {
            const url = `${location.origin}/api/tarea`;
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });

            const resultado = await respuesta.json();

            if (resultado.tipo === 'exito') {
                Swal.fire('Creado!', resultado.mensaje, 'success');

                const modal = document.querySelector('.modal');
                modal.remove();
            }

            //? Agregar el objeto de tarea al global de tareas
            const tareaObj = {
                id: String(resultado.id),
                nombre: tarea,
                estado: "0",
                proyectoId: resultado.proyectoId
            }

            tareas = [...tareas, tareaObj];
            mostrarTareas();

        } catch (error) {
            console.log(error);
        }
        
    }

    //? Cambiar estado de tareas
    function cambiarEstadoTarea(tarea) {
        const nuevoEstado = tarea.estado === "1" ? "0" : "1";
        tarea.estado = nuevoEstado;

        actualizarTarea(tarea);
    }

    //! Consultar servidor para actualizar tarea de proyecto
    async function actualizarTarea(tarea) {
        const {estado, id, nombre} = tarea;

        const datos = new FormData();
        datos.append('id', id);
        datos.append('estado', estado);
        datos.append('nombre', nombre);
        datos.append('proyectoId', obtenerProyecto());
        //for(let valor of datos.values()) {
        //    console.log(valor);
        //}
        try {
            const url = `${location.origin}/api/actualizar`;

            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();

            if (resultado.respuesta.tipo === 'exito') {
                Swal.fire('Actualizado!', resultado.respuesta.mensaje, 'success');

                const modal = document.querySelector('.modal');
                if(modal) {
                    modal.remove();
                }

                tareas = tareas.map(tareaMemoria => {
                    if (tareaMemoria.id === id) {
                        tareaMemoria.estado = estado;
                        tareaMemoria.nombre = nombre;
                    }

                    return tareaMemoria;
                });

                mostrarTareas();
            }
        } catch (error) {
            console.log(error);
        }
    }

    //? Alerta para eliminar tarea
    function confirmarEliminarTarea(tarea) {
        Swal.fire({
            title: 'Deseas eliminar la tarea?',
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            cancelButtonText: `Cancelar`,
        }).then((result) => {
            if (result.isConfirmed) {
                eliminarTarea(tarea);
            }
        });
    }

    //! Consultar servidor para eliminar tarea del proyecto
    async function eliminarTarea(tarea) {
        
        const datos = new FormData();
        const {estado, id, nombre} = tarea;
        datos.append('id', id);
        datos.append('estado', estado);
        datos.append('nombre', nombre);
        datos.append('proyectoId', obtenerProyecto());

        try {
            const url = `${location.origin}/api/eliminar`;

            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            });
            const resultado = await respuesta.json();

            if (resultado.respuesta) {
                Swal.fire('Eliminado!', resultado.respuesta.mensaje, 'success');

                tareas = tareas.filter(tareaMemoria => tareaMemoria.id !== tarea.id);
                mostrarTareas();
            }
        } catch (error) {
            console.log(error);
        }
    }

    //? Traer URL del proyecto
    function obtenerProyecto() {
        const proyectoParams = new URLSearchParams(window.location.search);
        const proyecto = Object.fromEntries(proyectoParams.entries());

        return proyecto.url;
    }

    //? Vaciar arreglos de tareas
    function limpiarTareas() {
        const listadoTareas = document.querySelector('#listado-tareas');

        while(listadoTareas.firstChild) {
            listadoTareas.removeChild(listadoTareas.firstChild);
        }
    }
})();