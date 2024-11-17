function mostrarOpcionesUbicacion() {
    const seleccion = document.getElementById("ubicacionTipo").value;
    const opcionesDescripcion = document.getElementById("opcionesDescripcion");
    const opcionMapaContenedor = document.getElementById("opcionMapaContenedor");

    opcionesDescripcion.style.display = seleccion === "descripcion" ? "block" : "none";
    opcionMapaContenedor.style.display = seleccion === "mapa" ? "block" : "none";
}

function mostrarCantones() {
    const cantonLabel = document.querySelector("label[for='canton']");
    const cantonSelect = document.getElementById("canton");
    const provinciaSeleccionada = document.getElementById("provincia").value;

    cantonLabel.style.display = "block"; //esto deja mostrando la opción seleccionada
    cantonSelect.style.display = "block";

    cantonSelect.innerHTML = '<option value="">Seleccione un cantón</option>';

    // Cantones por provincia
    const cantones = {
        "San José": ["San José", "Escazú", "Desamparados", "Puriscal", "Tarrazú"],
        "Alajuela": ["Alajuela", "San Ramón", "Grecia", "Atenas", "Naranjo"],
        "Cartago": ["Cartago", "Paraíso", "La Unión", "Jiménez", "Turrialba"],
        "Heredia": ["Heredia", "Barva", "Santo Domingo", "Santa Bárbara", "San Rafael"],
        "Guanacaste": ["Liberia", "Nicoya", "Santa Cruz", "Bagaces", "Carrillo"],
        "Puntarenas": ["Puntarenas", "Esparza", "Buenos Aires", "Montes de Oro", "Osa"],
        "Limón": ["Limón", "Pococí", "Siquirres", "Talamanca", "Matina"]
    };

    cantones[provinciaSeleccionada].forEach(canton => {
        cantonSelect.innerHTML += `<option value="${canton}">${canton}</option>`;
    });
}

function mostrarDistritos() {
    const distritoLabel = document.querySelector("label[for='distrito']");
    const distritoSelect = document.getElementById("distrito");
    const cantonSeleccionado = document.getElementById("canton").value;
    const direccionLabel = document.querySelector("label[for='direccionExacta']");
    const direccionInput = document.getElementById("direccionExacta");

    distritoLabel.style.display = "block";
    distritoSelect.style.display = "block";
    direccionLabel.style.display = "block";
    direccionInput.style.display = "block";

    distritoSelect.innerHTML = '<option value="">Seleccione un distrito</option>';

    
    const distritos = {
        // San José
        "San José": ["Carmen", "Merced", "Hospital", "Catedral", "Zapote", "San Francisco de Dos Ríos", "Uruca", "Mata Redonda", "Pavas", "Hatillo", "San Sebastián"],
        "Escazú": ["Escazú Centro", "San Rafael", "San Antonio"],
        "Desamparados": ["Desamparados Centro", "San Miguel", "San Juan de Dios", "San Rafael Arriba", "San Rafael Abajo", "Gravilias", "Damas", "Los Guido"],
        "Puriscal": ["Santiago", "Mercedes Sur", "Barbacoas", "Grifo Alto", "San Rafael", "Candelarita", "Desamparaditos", "San Antonio", "Chires"],
        "Tarrazú": ["San Marcos", "San Lorenzo", "San Carlos"],
    
        // Alajuela
        "Alajuela": ["Alajuela Centro", "San José", "Carrizal", "San Antonio", "Guácima", "San Isidro", "Sabanilla", "Turrúcares", "Tambor", "Garita", "Sarapiquí"],
        "San Ramón": ["San Ramón Centro", "Santiago", "San Juan", "Piedades Norte", "Piedades Sur", "San Rafael", "San Isidro", "Angeles", "Alfaro", "Volio", "Concepción", "Zapotal", "Peñas Blancas"],
        "Grecia": ["Grecia Centro", "San Isidro", "San José", "San Roque", "Tacares", "Puente de Piedra", "Bolívar"],
        "Atenas": ["Atenas Centro", "Jesús", "Mercedes", "San Isidro", "Concepción", "San José", "Santa Eulalia", "Escobal"],
        "Naranjo": ["Naranjo Centro", "San Miguel", "San José", "Cirrí Sur", "San Jerónimo", "San Juan", "Rosario", "Palmitos"],
    
        // Cartago
        "Cartago": ["Oriental", "Occidental", "Carmen", "San Nicolás", "Aguacaliente", "Guadalupe", "Corralillo", "Tierra Blanca", "Dulce Nombre", "Llano Grande", "Quebradilla"],
        "Paraíso": ["Paraíso Centro", "Santiago", "Orosi", "Cachí", "Llanos de Santa Lucía"],
        "La Unión": ["Tres Ríos", "San Diego", "San Juan", "San Rafael", "Concepción", "Dulce Nombre", "San Ramón", "Río Azul"],
        "Jiménez": ["Juan Viñas", "Tucurrique", "Pejibaye"],
        "Turrialba": ["Turrialba Centro", "La Suiza", "Peralta", "Santa Cruz", "Santa Teresita", "Pavones", "Tuis", "Tayutic", "Santa Rosa", "Tres Equis", "La Isabel", "Chirripó"],
    
        // Heredia
        "Heredia": ["Heredia Centro", "Mercedes", "San Francisco", "Ulloa", "Vara Blanca"],
        "Barva": ["Barva Centro", "San Pedro", "San Pablo", "San Roque", "Santa Lucía", "San José de la Montaña"],
        "Santo Domingo": ["Santo Domingo Centro", "San Vicente", "San Miguel", "Paracito", "Santo Tomás", "Santa Rosa", "Tures", "Pará"],
        "Santa Bárbara": ["Santa Bárbara Centro", "San Pedro", "San Juan", "Jesús", "Santo Domingo", "Purabá"],
        "San Rafael": ["San Rafael Centro", "San Josecito", "Santiago", "Los Ángeles", "Concepción"],
    
        // Guanacaste
        "Liberia": ["Liberia Centro", "Cañas Dulces", "Mayorga", "Nacascolo", "Curubandé"],
        "Nicoya": ["Nicoya Centro", "Mansión", "San Antonio", "Quebrada Honda", "Sámara", "Nosara", "Belén de Nosarita"],
        "Santa Cruz": ["Santa Cruz Centro", "Bolsón", "Veintisiete de Abril", "Tempate", "Cartagena", "Cuajiniquil", "Diriá", "Cabo Velas", "Tamarindo"],
        "Bagaces": ["Bagaces Centro", "Fortuna", "Mogote", "Río Naranjo"],
        "Carrillo": ["Filadelfia", "Palmira", "Sardinal", "Belén"],
    
        // Puntarenas
        "Puntarenas": ["Puntarenas Centro", "Pitahaya", "Chomes", "Lepanto", "Paquera", "Manzanillo", "Guacimal", "Barranca", "Monte Verde", "Isla del Coco"],
        "Esparza": ["Espíritu Santo", "San Juan Grande", "Macacona", "San Rafael", "San Jerónimo"],
        "Buenos Aires": ["Buenos Aires Centro", "Volcán", "Potrero Grande", "Boruca", "Pilas", "Colinas", "Chánguena", "Biolley", "Brunka"],
        "Montes de Oro": ["Miramar", "La Unión", "San Isidro"],
        "Osa": ["Cortés", "Palmar", "Sierpe", "Bahía Ballena", "Piedras Blancas"],
    
        // Limón
        "Limón": ["Limón Centro", "Valle La Estrella", "Río Blanco", "Matama"],
        "Pococí": ["Guápiles", "Jiménez", "Rita", "Roxana", "Cariari", "Colorado"],
        "Siquirres": ["Siquirres Centro", "Pacuarito", "Florida", "Germania", "El Cairo", "Alegría"],
        "Talamanca": ["Bratsi", "Sixaola", "Cahuita", "Telire"],
        "Matina": ["Matina Centro", "Batán", "Carrandi"]
    };
    

    distritos[cantonSeleccionado].forEach(distrito => {
        distritoSelect.innerHTML += `<option value="${distrito}">${distrito}</option>`;
    });
}
