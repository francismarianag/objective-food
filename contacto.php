<?php require_once('_head.php'); ?>
<title>Contacto | Objective Food</title>
  </head>
<?php
//convoca al header
require_once('_header.php');
?>

<body>
    <main>

            <section class="contact-header">
                <div class="back-blur">
                
                </div>
                <h2>Contanos tu experiencia</h2>
            </section>
            <section class="contact-container">
                <article >
                    <form action="" class="contact-form">

                            <input type="text" id="name" class="form-input" placeholder="Nombre y Apellido" require>

                            <input type="email" id="email" class="form-input" placeholder="Email" require>

                            <input type="number" id="telefono" class="form-input" placeholder="Numero de contacto">

                            <input type="text" id="motivo" class="form-input" placeholder="Motivo de la consulta" require>


                            <textarea rows="4" cols="50" id="mensaje" class="form-input" placeholder="Mensaje"></textarea>

                        </div>
                        <button class="form-row form-button" type="submit" name="send-contact">Enviar</button>
                    </form>
                </article>
                <article class="contact-info">
                    <div class="info">
                    <i class="fas fa-envelope"></i>
                    <p>contacto@objetctivefood.com</p>
                    </div>
                    <div class="info">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>Monroe 860, Belgrano</p>
                    </div>
                    <div class="info">
                    <i class="fas fa-phone"></i>
                    <p>+54 911 3934 2713</p>
                    </div>
                </article>
            </section>

</main>
</body>


<?php
//convoca al footer
require_once('_footer.php');
