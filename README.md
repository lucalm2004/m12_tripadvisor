# Proyecto TripAdvisor

Bienvenido al proyecto TripAdvisor, una plataforma web diseñada para permitir a los usuarios compartir reseñas y experiencias sobre restaurantes. Este documento proporciona una visión general del proyecto, su funcionamiento, ubicación de la base de datos y los miembros del equipo que contribuyeron al desarrollo.

## Descripción del Proyecto

El proyecto TripAdvisor es una aplicación web inspirada en la famosa plataforma de reseñas de restaurantes. Permite a los usuarios buscar restaurantes según diferentes criterios, ver detalles y reseñas de cada restaurante, y compartir sus propias experiencias. La interfaz de usuario es intuitiva y fácil de usar, con características avanzadas como filtros de búsqueda, actualización automática de contenido y modal de restaurante detallado.

## Funcionamiento

El proyecto se basa en un buscador principal con tres filtros clave: estrellas, precio y tipo de comida. Estos filtros permiten a los usuarios refinar su búsqueda y encontrar restaurantes específicos según sus preferencias. Además, se incluye un botón de reinicio para restablecer los filtros a sus valores predeterminados.

La aplicación utiliza tecnología AJAX para mejorar la experiencia del usuario, permitiendo la carga dinámica de contenido sin necesidad de recargar la página. Esto se aplica tanto en la búsqueda de restaurantes como en la visualización de detalles de cada restaurante, lo que proporciona una experiencia fluida y rápida.

Cada restaurante tiene su propia página de detalles, accesible a través de un modal, que muestra información detallada sobre el restaurante, incluyendo reseñas de otros usuarios y una caja de comentarios con calificación por estrellas.

Además, la página principal cuenta con dos banners dinámicos que muestran el restaurante más caro y el más barato según los precios registrados en la base de datos.

Para mantener la información actualizada, el contenido se actualiza automáticamente cada minuto, lo que garantiza que los usuarios siempre tengan acceso a datos frescos y relevantes.

## Ubicación de la Base de Datos

La base de datos del proyecto se encuentra en la carpeta `inc/conexion.php` y lleva el nombre `db_tripadvisor`. Esta base de datos almacena toda la información relevante sobre los restaurantes, incluyendo detalles, reseñas, comentarios y precios.

## Miembros del Equipo

El desarrollo de este proyecto ha sido posible gracias al esfuerzo y dedicación de los siguientes miembros del equipo:

- Manel García
- Alberto Bermejo
- Ian Romero
- Luca Lusuardi

Cada miembro ha contribuido con sus habilidades y conocimientos para hacer de este proyecto una realidad.

¡Gracias por visitar nuestro proyecto TripAdvisor!

