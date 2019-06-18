CREATE DATABASE IF NOT EXISTS `pruebaProgramacion` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pruebaProgramacion`;

CREATE TABLE IF NOT EXISTS `EmpleadosPersonal` (
  `Nombres` varchar(100) NOT NULL,
  `Apellidos` varchar(100) NOT NULL,
  `Cedula` varchar(13) NOT NULL,
  `Provincia` varchar(20) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Observaciones` varchar(255) NOT NULL,
  `FechaIngreso` date NOT NULL,
  `Estado` varchar(10) NOT NULL,
  `Cargo` varchar(100) NOT NULL,
  `Departamento` varchar(100) NOT NULL,
  `ProvinciaLaboral` varchar(100) NOT NULL,
  `Sueldo` double NOT NULL,
  `JornadaParcial` varchar(2) NOT NULL DEFAULT 'NO',
  `ObservacionesLaboral` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `EmpleadosPersonal` (`Nombres`, `Apellidos`, `Cedula`, `Provincia`, `FechaNacimiento`, `Email`, `Observaciones`, `FechaIngreso`, `Estado`, `Cargo`, `Departamento`, `ProvinciaLaboral`, `Sueldo`, `JornadaParcial`, `ObservacionesLaboral`) VALUES
('gaby', 'rivera', '0703413252', 'El Oro', '2019-06-11', 'mmm@aaa.com', 'qwertyuiop', '0000-00-00', 'Activo', '', '', '', 0, 'NO', ''),
('jorge', 'gallardo', '0705053197', 'El Oro', '2019-06-11', 'mmm@aaa.com', 'qwertyuiop', '0000-00-00', 'Activo', '', '', '', 0, 'NO', '');

CREATE TABLE IF NOT EXISTS `Provincia` (
  `nombre_provincia` varchar(250) NOT NULL,
  `capital_provincia` varchar(250) NOT NULL,
  `descripcion_provincia` varchar(250) NOT NULL,
  `poblacion_provincia` double NOT NULL,
  `superficie_provincia` double NOT NULL,
  `latitud_provincia` double NOT NULL,
  `longitud_provincia` double NOT NULL,
  `id_region` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `Provincia` (`nombre_provincia`, `capital_provincia`, `descripcion_provincia`, `poblacion_provincia`, `superficie_provincia`, `latitud_provincia`, `longitud_provincia`, `id_region`) VALUES
('Azuay', 'Cuenca', 'Es llamada la Atenas del Ecuador por su arquitectura, su diversidad cultural, su aporte a las artes, ciencias y letras ecuatorianas y por ser el lugar de nacimiento de muchos personajes ilustres de la sociedad ecuatoriana', 569.42, 122, -2.902222, -79.005261, '1'),
('Bolivar', 'Guaranda', 'Bolívar es una provincia del centro de Ecuador, en la cordillera occidental de los Andes. Su capital es la ciudad de Guaranda. La Provincia de Bolívar se llama así en honor al Libertador Simón Bolívar.', 183, 3254, -1.6, -79, '1'),
('Cañar', 'Azoguez', 'La provincia destaca como uno de los sitios turísticos más importantes del país, destacándose entre otros la Fortaleza de Ingapirca, la Laguna de Culebrillas y la ciudad de Azogues.', 33848, 3908, -2.733333, -78.833333, '1'),
('Carchi', 'Tulcán', 'Carchi es una provincia ecuatoriana situada al norte del Ecuador en la frontera con Colombia. Su\ncapital es la ciudad de Tulcán. Forma parte de la región 1', 82734, 3783, 0.811667, -77.718611, '1'),
('Chimborazo', 'Riobamba', 'En esta provincia se encuentran varias de las cumbres más elevadas del país, como el Carihuairazo, el Altar, Igualata, Sangay, entre otros, que en algunos casos comparte con otras provincias.', 223586, 6487, -1.666667, -78.65, '1'),
('Cotopaxi', 'Latacunga', 'La provincia toma el nombre del volcán más grande e importante de su territorio, el volcán Cotopaxi. Cotopaxi se encuentra dividida políticamente en 7 cantones. Según el último ordenamiento territorial, la provincia de Cotopaxi pertenece a la región ', 409, 6569, -0.933333, -78.616667, '1'),
('El Oro', 'Machala', 'La capital de la provincia de El Oro es la ciudad de Machala, quinta ciudad del país, considerada como la capital bananera del mundo .', 260528, 6188, -3.266669, -79.9667, '2'),
('Esmeraldas', 'Esmeraldas', 'Provincia del Ecuador situada en su costa noroccidental,conocida popularmente como la provincia verde. Sucapital homónima es uno de los puertosprincipales del Ecuador y terminal del oleoducto transandino. Posee un aeropuerto para vuelos nacionales e ', 189504, 15, -0.966667, -79.65, '2'),
('Galápagos', 'P. Baquerizo Moreno', 'Es el mayor centro turístico del Ecuador, así como también una de las reservas ecológicas más grandes e importantes del planeta. Con sus 26.640 habitantes, Galápagos es la provincia menos poblada del país, debido principalmente al afán de conservar a', 5600, 8010, -0.666667, -90.55, '3'),
('Guayas', 'Guayaquil', 'Es el mayor centro comercial e industrial del Ecuador. Con sus 3,8 millones de habitantes, Guayas es la provincia más poblada del país, constituyéndose con el 24,5% de la población de la República.', 2526927, 17139, -2.2, -79.9667, '2'),
('Imbabura', 'Ibarra', 'La provincia también es conocida por sus contrastes poblacionales es así que la población está marcada por diferentes factores demográficos, además desde siempre ha sido núcleo de artesanías y cultura.', 181722, 4599, 0.35, -78.133333, '1'),
('Loja', 'Loja', 'Loja es una ciudad del Ecuador, capital de la provincia y cantón Loja, tiene una rica tradición en las artes, y por esta razón es conocida como la capital musical y cultural del Ecuador.', 206.83, 57, -3.833, -80.067, '1'),
('Los Rios', 'Babahoyo', 'Los Ríos, oficialmente Provincia de Los Ríos, es una de las 24 provincias de la República del Ecuador, localizada en la Región Costa del país. Su capital es la ciudad de Babahoyo y su localidad más poblada es la ciudad de Quevedo. Es uno de los más i', 778115, 6254, -1.766669, -79.45, '2'),
('Manabí', 'Portoviejo', 'Manabí es una provincia ecuatoriana localizada en el emplazamiento centro-noroeste del Ecuador continental, cuya unidad jurídica se ubica en la región geográfica del litoral, que a su vez se encuentra dividida por el cruce de la línea equinoccial. Su', 1369780, 18400, -1.052219, -80.4506, '2'),
('Morona Santiago', 'Macas', 'Morona Santiago (nombre oficial Provincia de Morona Santiago) es una de las 24 provincias que conforman la República del Ecuador. Es una provincia de la Amazoníaecuatoriana. Su capital es la ciudad de Macas, la cual además, es su urbe más poblada. Su', 147940, 25690, -2.366667, -78.133333, '4'),
('Napo', 'Tena', 'La provincia de Napo es una de las provincias de la Región Centro Norte (Ecuador), de la República del Ecuador, situada en la región amazónica ecuatoriana e incluyendo parte de las laderas de los Andes, hasta las llanuras amazónicas. Toma su nombre d', 103697, 13271, 0.989, -77.8159, '4'),
('Orellana', 'Francisco de Orellana', 'Orellana, provincia de la Región Centro Norte (Ecuador), Ecuador, La capital de la provincia es El Coca más conocida como «Coca». Al norte limita con Sucumbíos, al sur con la provincia de Pastaza, al este con Perú y al oeste con Napo. Tiene una super', 136396, 20773, -0.933333, -75.666667, '4'),
('Pastaza', 'Puyo', 'Pastaza, oficialmente Provincia de Pastaza, es una de las 24 provincias que conforman la República del Ecuador, situada en laRegión Amazónica del Ecuador. Recibe su nombre del río Pastaza, que la separa al sur de la provincia de Morona Santiago. Su c', 83933, 29520, -1.066667, -78.001111, '4'),
('Pichincha', 'Quito', 'La Provincia de Pichincha es una de las 24 provincias que conforman la República del Ecuador. Se encuentra ubicada al norte del país, en la zona geográfica conocida como sierra. Su capital administrativa es la ciudad de Quito, la cual además es su ur', 2576287, 9612, -0.25, -78.583333, '1'),
('Santa Elena', 'Santa Elena', 'Santa Elena es una provincia de la costa de Ecuador creada el 7 de noviembre de 2007, la más reciente de las 24 actuales, con territorios que anterior a esa fecha formaban parte de la provincia del Guayas, al oeste de ésta.', 308693, 3763, -2.2267, -80.8583, '2'),
('Santo Domingo de los Tsáchilas', 'Santo Domingo', 'La Provincia de Santo Domingo de los Tsáchilas es una de las provincias de la República del Ecuador y forma parte de laRegión Costa, históricamente conocida como Provincia de Yumbos. Su territorio está en zona de trópico húmedo. La provincia toma su ', 410937, 4180, -0.333333, -79.25, '2'),
('Sucumbios', 'Nueva Loja', 'Sucumbíos es una provincia del nor-oriente del Ecuador. Su capital es Nueva Loja. Es una de las principales provincias que proveen al Estado ecuatoriano del petróleo que necesita para las exportaciones. Se caracteriza por sus bellos paisajes amazónic', 176472, 18612, -0.083333, -76.883333, '4'),
('Tungurahua', 'Ambato', 'Tungurahua, oficialmente Provincia de Tungurahua, es una de las 24 provincias que conforman la República del Ecuador. Se encuentra al centro del país, en la región geográfica conocida como sierra. La ciudad de Ambato es su capital administrativa; se ', 504583, 3334, -1.233333, -78.616667, '1'),
('Zamora Chimchipe', 'Zamora', 'Zamora Chinchipe es una provincia de Ecuador ubicada en el sur-oriente de la Amazonía ecuatoriana, que limita con la provincia de Morona Santiago al norte; con la provincia de Loja al oeste; y con Perú al sur y este. Según el último ordenamiento terr', 91376, 10556, -2.883333, -79, '4');
