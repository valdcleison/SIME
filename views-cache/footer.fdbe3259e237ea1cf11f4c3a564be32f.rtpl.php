<?php if(!class_exists('Rain\Tpl')){exit;}?> <footer class="footer-area relative sky-bg" id="contact-page">
        <div class="absolute footer-bg"></div>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-sm-offset-3 text-center">
                        <div class="page-title">
                            <h2>Entre em Contato</h2>
                            <p>Duvidas, problemas ou sugetão, entre em contato conosco.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <address class="side-icon-boxes">
                            <div class="side-icon-box">
                                <div class="side-icon">
                                    <img src="images/location-arrow.png" alt="">
                                </div>
                                <p><strong>Endereço: </strong> Rua São Paulo 564, Centro <br />Juazeiro do Norte - CE</p>
                            </div>
                            <div class="side-icon-box">
                                <div class="side-icon">
                                    <img src="images/phone-arrow.png" alt="">
                                </div>
                                <p><strong>Telefone: </strong>
                                    <a href="callto:8801812726495">+87991154745</a> <br />
                                    <a href="callto:8801687420471">+-</a>
                                </p>
                            </div>
                            <div class="side-icon-box">
                                <div class="side-icon">
                                    <img src="images/mail-arrow.png" alt="">
                                </div>
                                <p><strong>E-mail: </strong>
                                    <a href="mailto:valdcleisonvaldeci@gmail.com">valdcleisonvaldeci@gmail.com</a> <br />
                                    <a href="mailto:sime@packetsoftware.com">sime@packetsoftware.com</a>
                                </p>
                            </div>
                        </address>
                    </div>
                    <div class="col-xs-12 col-md-1">
                    </div>
                    <div class="col-xs-12 col-md-7">
                        <form action="process.php" id="contact-form" method="post" class="contact-form">
                            <div class="form-double">
                                <input type="text" id="form-name" name="form-name" placeholder="Seus Nome" class="form-control" required="required">
                                <input type="email" id="form-email" name="form-email" class="form-control" placeholder="E-mail" required="required">
                            </div>
                            <input type="text" id="form-subject" name="form-subject" class="form-control" placeholder="Assunto">
                            <textarea name="message" id="form-message" name="form-message" rows="5" class="form-control" placeholder="Sua Mensagem" required="required"></textarea>
                            <button type="sibmit" class="button">ENVIAR</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-middle">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 ">
                        <ul class="social-menu">
                            <li><a href="#"><i class="ti-facebook"></i></a></li>
                            <li><a href="#"><i class="ti-twitter"></i></a></li>
                            <li><a href="#"><i class="ti-google"></i></a></li>
                            <li><a href="#"><i class="ti-linkedin"></i></a></li>
                            <li><a href="#"><i class="ti-github"></i></a></li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <p>&copy;Copyright 2018 Todos os direitos reservados.  Feito com <i class="ti-heart" aria-hidden="true"></i> por <a href="#">Packet Software</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>





    <!--Vendor-JS-->
    <script src="/res/Layout/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="/res/Layout/js/vendor/bootstrap.min.js"></script>
    <!--Plugin-JS-->
    <script src="/res/Layout/js/owl.carousel.min.js"></script>
    <script src="/res/Layout/js/contact-form.js"></script>
    <script src="/res/Layout/js/jquery.parallax-1.1.3.js"></script>
    <script src="/res/Layout/js/scrollUp.min.js"></script>
    <script src="/res/Layout/js/magnific-popup.min.js"></script>
    <script src="/res/Layout/js/wow.min.js"></script>
    <!--Main-active-JS-->
    <script src="/res/Layout/js/main.js"></script>
</body>

</html>
