<!--==========================
      Contact Section
    ============================-->
<section id="contact" class="section-bg wow fadeInUp">
    <div class="container">
        <div class="section-header">
            <h2>Contato</h2>
            <p>Deixe aqui sua mensagem</p>
        </div>
        <div class="row contact-info">
            <div class="col-md-4">
                <div class="contact-address">
                    <i class="ion-ios-location-outline"></i>
                    <h3>Endereço</h3>
                    <address>Av. Prof. Osvaldo de Oliveira, 375 - Conj. Res. José Bonifácio, São Paulo</address>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-phone">
                    <i class="ion-ios-telephone-outline"></i>
                    <h3>Telefone</h3>
                    <p><a href="tel:+551129615822">+55 11 2961 5822</a></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-email">
                    <i class="ion-ios-email-outline"></i>
                    <h3>Email</h3>
                    <p><a href="mailto:ibanov-sp@hotmail.com">ibanov-sp@hotmail.com</a></p>
                </div>
            </div>
        </div>
        <div class="form">
            <div id="sendmessage">Sua mensagem foi enviada. Obrigado!</div>
            <div id="errormessage"></div>
            <form action="" method="post" role="form" class="contactForm">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input aria-label="Nome" type="text" name="name" class="form-control" id="name"
                               placeholder="Seu nome" data-rule="minlen:4" data-msg="Digite ao menos 4 caracteres"/>
                        <div class="validation"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <input aria-label="Email" type="email" class="form-control" name="email" id="email"
                               placeholder="Seu email" data-rule="email" data-msg="Insira um email válido"/>
                        <div class="validation"></div>
                    </div>
                </div>
                <div class="form-group">
                    <input aria-label="Assunto" type="text" class="form-control" name="subject" id="subject"
                           placeholder="Assunto" data-rule="minlen:8"
                           data-msg="Digite ao menos 8 caracteres"/>
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <textarea aria-label="Mensagem" class="form-control" name="message" rows="5" data-rule="required"
                              data-msg="Escreva algo para nós" placeholder="Mensagem"></textarea>
                    <div class="validation"></div>
                </div>
                <div class="text-center">
                    <button type="submit">Enviar mensagem</button>
                </div>
            </form>
        </div>
    </div>
</section><!-- #contact -->
