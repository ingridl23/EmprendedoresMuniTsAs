<link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-lg-8 col-xl-6 text-center">
            <h2 class="mt-0"> Unite como emprendedor</h2>
            <hr class="divider" />
            <p class="text-muted mb-5">
                Completá el formulario con tus datos y desde la Oficina de Cultura nos pondremos en contacto para que
                puedas integrarte a esta valiosa propuesta.

            </p>
        </div>
    </div>
    <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
        <div class="col-lg-6">

            <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                <!-- Name input-->
                <div class="form-floating mb-3">
                    <input class="form-control" id="name" type="text" placeholder="Enter your name..."
                        data-sb-validations="required" />
                    <label for="name">Nombre y apellido (nombre completo)</label>
                    <div class="invalid-feedback" data-sb-feedback="name:required">completa con al menos un nombre y un
                        apellido.
                    </div>
                </div>
                <!-- Email address input-->
                <div class="form-floating mb-3">
                    <input class="form-control" id="email" type="email" placeholder="name@example.com"
                        data-sb-validations="required,email" />
                    <label for="email">Correo electronico</label>
                    <div class="invalid-feedback" data-sb-feedback="email:required">ingresa un correo que uses con
                        regularidad.
                    </div>
                    <div class="invalid-feedback" data-sb-feedback="email:email">ingresa un email valido (ejemplo :
                        @example.com).</div>
                </div>
                <!-- Phone number input-->
                <div class="form-floating mb-3">
                    <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890"
                        data-sb-validations="required" />
                    <label for="phone">Numero de telefono</label>
                    <div class="invalid-feedback" data-sb-feedback="phone:required">ingresa un numero de telefono que
                        manejes diariamente</div>
                </div>
                <!-- Message input-->
                <div class="form-floating mb-3">
                    <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..."
                        style="height: 10rem" data-sb-validations="required"></textarea>
                    <label for="message">Describe brevemente tu emprendimiento y a que te dedicas.</label>
                    <div class="invalid-feedback" data-sb-feedback="message:required"> Completa con una breve
                        presentacion sobre tu emprendimiento.
                    </div>
                </div>
                <!-- Submit success message-->
                <!---->
                <!-- This is what your users will see when the form-->
                <!-- has successfully submitted-->
                <div class="d-none" id="submitSuccessMessage">
                    <div class="text-center mb-3">
                        <div class="fw-bolder">Enviado exitosamente!</div>
                        Gracias por completar el formulario, estamos felices que quieras ser parte de esta gran
                        iniciativa. En la brevedad nos comunicaremos con vos para que puedas formar parte.
                        <br />
                        <a
                            href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                    </div>
                </div>
                <!-- Submit error message-->
                <!---->
                <!-- This is what your users will see when there is-->
                <!-- an error submitting the form-->
                <div class="d-none" id="submitErrorMessage">
                    <div class="text-center text-danger mb-3">Ocurrio un error al enviar tu respuesta, verifica que
                        tengas conexion o que se hayan ingresado los datos correctamente
                    </div>
                </div>
                <!-- Submit Button-->
                <div class="d-grid"><button class="btn btn-primary btn-xl disabled" id="submitButton"
                        type="submit">Enviar Peticion</button></div>
            </form>
        </div>
    </div>

</div>
