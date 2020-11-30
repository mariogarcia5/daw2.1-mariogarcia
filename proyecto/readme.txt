He creado una base de datos para que gestionase las tablas de equipo y de jugador.

Mi idea principal era hacer una base de datos que pudiese gestionar una liguilla de fútbol en la que hubiese varios
equipos con su correspondiente información y jugadores con su correspondiente información incluyendo al equipo al que
pertenecen, el cual debe ser uno que ya esté creado.

Dichos jugadores se pueden crear, modificar y eliminar por si algún jugador llega nuevo a la liga, se cambia de equipo...etc.

El problema estaba en que al eliminar un equipo me daba error porque había jugadores asociados a ese equipo por lo que
he decidido que los equipos se gestionen directamente desde la base de datos porque al ser siempre constantes y no
haber ascensos ni descensos, no tendran que ser cambiados (salvo creación o baja de algún equipo). Aún así he mantenido
la opción de modificar equipos por si algún equipo modifica alguno de sus datos.

En la ficha del jugador he puesto que el equipo sea un desplegable en el cual se pueda elegir solo uno de los equipos que ya están
creados. Tenía pensado haber hecho lo mismo con las posiciones de los jugadores pero al final he dejado que se escriban a mano
debido a que cada equipo juega con un sistema y llaman de forma diferente a las posiciones (ej, lateral, carrilero, extremo...).

Tenía intención de haber metido las sesiones pero he tenido varios problemas en los que me he atascado y he perdido mucho tiempo.

También he introducido un apartado en el que se muestran los jugadores que tiene cada equipo, al cual se accede desde
la ficha del equipo.