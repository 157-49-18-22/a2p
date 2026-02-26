<!--Site Footer Start-->

<style>
    .footer-widget__title {
        color: black;
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 25px;
    }

    .footer-widget__title:before {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 35px;
        height: 3px;
        background: #c00415;
    }

    .footer-widget__explore-list li a {
        color: black;
        transition: all 0.3s ease;
    }
    
    .footer-widget__explore-list li a:hover {
        color: #c00415;
        padding-left: 5px;
    }

    .footer-widget__services-list li a {
        color: #000000;
        transition: all 0.3s ease;
    }
    
    .footer-widget__services-list li a:hover {
        color: #c00415;
        padding-left: 5px;
    }

    .footer-widget__contact-list li .text h5 {
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #666;
        margin-bottom: 4px;
    }

    .footer-widget__contact-list li .text p {
        color: #000000;
        font-weight: 600;
        line-height: 1.5;
    }

    .footer-widget__contact-list li .text p a {
        color: #000000;
        transition: color 0.3s;
    }
    
    .footer-widget__contact-list li .text p a:hover {
        color: #c00415;
    }

    .footer-widget__about-text {
        color: #444;
        line-height: 1.8;
        margin-bottom: 25px;
    }

    .site-footer-two .site-footer__top {
        box-shadow: 0 -5px 20px rgba(0,0,0,0.05);
        padding: 80px 0 50px;
    }

    .footer-widget__logo img {
        max-height: 80px;
        width: auto !important;
        object-fit: contain;
    }

    .footer-widget__contact-list li {
        display: flex;
        align-items: flex-start;
        margin-bottom: 20px;
        gap: 15px;
    }

    .footer-widget__contact-list li .icon {
        width: 45px;
        height: 45px;
        background: #c00415;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff !important;
        font-size: 18px;
        flex-shrink: 0;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(192, 4, 21, 0.2);
    }

    .footer-widget__contact-list li .icon span,
    .footer-widget__contact-list li .icon i {
        color: #fff !important;
    }

    .footer-widget__contact-list li:hover .icon {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 6px 15px rgba(192, 4, 21, 0.3);
    }

    .footer-widget__contact {
        margin-left: 0 !important;
    }

    .logo-box img {
        width: 155px !important;
        height: auto !important;
        object-fit: contain !important;
    }

    /* Colorful Footer Social Icons */
    .site-footer__social a {
        background: #333 !important; /* Default */
        color: #fff !important;
        transition: all 0.3s ease !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 40px !important;
        height: 40px !important;
        border-radius: 50% !important;
        margin-right: 8px !important;
        font-size: 16px !important;
    }

    .site-footer__social a.facebook { background: #1877F2 !important; }
    .site-footer__social a.twitter { background: #000 !important; }
    .site-footer__social a.instagram { background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%) !important; }
    .site-footer__social a.linkedin { background: #0077B5 !important; }
    .site-footer__social a.youtube { background: #FF0000 !important; }
    .site-footer__social a.whatsapp { background: #25D366 !important; }

    .site-footer__social a:hover {
        transform: translateY(-3px) !important;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2) !important;
        opacity: 0.9 !important;
    }
</style>

<footer class="site-footer site-footer-two">
    <div class="site-footer-bg" style="background:white;">
    </div>
    <div class="site-footer__top">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                    <div class="footer-widget__column footer-widget__about">
                        <div class="footer-widget__logo">
                            <a href="<?= SITE_URL; ?>"><img src="<?= SITE_URL; ?>upload/<?php echo $pr_add['photo']; ?>" alt="Logo"></a>
                        </div>
                        <div class="footer-widget__about-text-box">
                            <p class="footer-widget__about-text">A2P Realtech is setting new standards for excellence and transforming the way real estate services are delivered.</p>
                        </div>
                        <div class="site-footer__social">
                            <a href="<?php echo $pr_add['facebook']; ?>" class="facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="<?php echo $pr_add['twitter']; ?>" class="twitter"><i class="fab fa-x-twitter"></i></a>
                            <a href="<?php echo $pr_add['instagram']; ?>" class="instagram"><i class="fab fa-instagram"></i></a>
                            <a href="<?php echo $pr_add['youtube']; ?>" class="youtube"><i class="fab fa-youtube"></i></a>
                            <a href="<?php echo $pr_add['linkedin']; ?>" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                            <a href="https://api.whatsapp.com/send?phone=91<?php echo $pr_add['phone']; ?>" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
                <!--<div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">-->
                <!--    <div class="footer-widget__column footer-widget__explore clearfix">-->
                <!--        <h3 class="footer-widget__title">Projects</h3>-->
                <!--        <ul class="footer-widget__explore-list list-unstyled clearfix">-->
                <!--            <li><a href="<?= SITE_URL; ?>residential.php">Residential</a></li>-->
                <!--            <li><a href="<?= SITE_URL; ?>commercial.php">Commercial</a></li>-->
                            

                <!--        </ul>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                    <div class="footer-widget__column footer-widget__services clearfix">
                        <h3 class="footer-widget__title">Quicklinks</h3>
                        <ul class="footer-widget__services-list list-unstyled clearfix">


                            
                                    <li><a href="<?= SITE_URL; ?>sitemap.html">Site Map </a></li>
                                    <li><a href="<?= SITE_URL; ?>terms_conditions.php">Terms And Conditions </a></li>
                                    <li><a href="<?= SITE_URL; ?>privacy_policy.php">Privacy Policy </a></li>
                                    <li><a href="<?= SITE_URL; ?>blog.php">Blog </a></li>
                                    <li><a href="<?= SITE_URL; ?>contact.php">Contact Us </a></li>
                                    <li><a href="<?= SITE_URL; ?>career.php">Career </a></li>

                            

                        </ul>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                    <div class="footer-widget__column footer-widget__contact clearfix">
                        <h3 class="footer-widget__title">Contact</h3>
                        <ul class="footer-widget__contact-list list-unstyled clearfix">
                            <li>
                                <div class="icon">
                                    <span class="icon-phone-call"></span>
                                </div>
                                <div class="text">
                                    <h5>Call anytime</h5>
                                    <p><a href="tel:+91-8130525001">+91-8130525001</a></p>
                                    <p><a href="tel:+91-8130510678">+91-8130510678</a></p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-message"></span>
                                </div>
                                <div class="text">
                                    <h5>Send email</h5>
                                    <p><a href="mailto:<?php echo $pr_add['email']; ?>"><?php echo $pr_add['email']; ?></a></p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <span class="icon-location"></span>
                                </div>
                                <div class="text">
                                    <h5>Address</h5>
                                    <p><?php echo $pr_add['addr']; ?></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="site-footer__bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="site-footer__bottom-inner">
                        <p class="site-footer__bottom-text">© Copyright  by <a href="<?= SITE_URL; ?>">A2P Realtech</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--Site Footer End-->


</div>


<div class="mobile-nav__wrapper">
    <div class="mobile-nav__overlay mobile-nav__toggler"></div>
    <!-- /.mobile-nav__overlay -->
    <div class="mobile-nav__content">
        <span class="mobile-nav__close mobile-nav__toggler"><i class="fa fa-times"></i></span>

        <div class="logo-box">
            <a href="#" aria-label="logo image"><img src="<?= SITE_URL; ?>upload/<?php echo $pr_add['photo']; ?>"
                    width="155" alt="" /></a>
        </div>
        <!-- /.logo-box -->
        <style>
            .mobile-nav__search-box {
                padding: 15px 20px 15px;
                border-bottom: 1px solid rgba(255,255,255,0.05);
                margin-top: 5px;
            }
            .mobile-nav__search-box form {
                position: relative;
                display: flex;
                align-items: center;
                background: rgba(255,255,255,0.08);
                border-radius: 12px;
                padding: 12px 18px;
                border: 1px solid rgba(255,255,255,0.15);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            }
            .mobile-nav__search-box form:focus-within {
                background: rgba(255,255,255,1);
                border-color: #c00415;
                box-shadow: 0 8px 25px rgba(192, 4, 21, 0.2);
                transform: translateY(-2px);
            }
            .mobile-nav__search-box input {
                width: 100%;
                background: transparent;
                border: none;
                color: #fff;
                font-size: 16px;
                font-weight: 500;
                outline: none !important;
                letter-spacing: 0.3px;
            }
            .mobile-nav__search-box form:focus-within input {
                color: #222;
            }
            .mobile-nav__search-box button {
                background: transparent;
                border: none;
                color: rgba(255,255,255,0.8);
                font-size: 20px;
                cursor: pointer;
                transition: all 0.3s;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .mobile-nav__search-box form:focus-within button {
                color: #c00415;
                transform: scale(1.1);
            }
            .mobile-nav__search-box input::placeholder {
                color: rgba(255,255,255,0.5);
                transition: all 0.3s;
            }
            .mobile-nav__search-box form:focus-within input::placeholder {
                color: #999;
            }
        </style>

        <div class="mobile-nav__search-box">
            <form action="<?= SITE_URL; ?>search_result.php" method="GET">
                <input type="text" name="query" placeholder="Tell us what you're looking for..." required>
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <div class="mobile-nav__container"></div>
        <!-- /.mobile-nav__container -->

        <ul class="mobile-nav__contact list-unstyled">
            <li>
                <i class="fa fa-phone-alt"></i>
                <a href="tel:+91-8130525001"><?php echo $pr_add['phone']; ?></a>
            </li>
        </ul><!-- /.mobile-nav__contact -->
        <div class="mobile-nav__top">
            <div class="mobile-nav__social">
                            <a href="<?php echo $pr_add['facebook']; ?>" class="facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="<?php echo $pr_add['twitter']; ?>" class="twitter"><i class="fab fa-x-twitter"></i></a>
                            <a href="<?php echo $pr_add['instagram']; ?>" class="instagram"><i class="fab fa-instagram"></i></a>
                            <a href="<?php echo $pr_add['youtube']; ?>" class="youtube"><i class="fab fa-youtube"></i></a>
                            <a href="<?php echo $pr_add['linkedin']; ?>" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                            <a href="https://api.whatsapp.com/send?phone=91<?php echo $pr_add['phone']; ?>" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
            </div><!-- /.mobile-nav__social -->
        </div><!-- /.mobile-nav__top -->



    </div>
    <!-- /.mobile-nav__content -->
</div>


<style>
/* Premium Search Popup Redesign */
.search-popup {
    background: rgba(0, 0, 0, 0.9);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.search-popup__content {
    max-width: 800px !important;
    width: 90%;
    margin: 0 auto;
    position: relative;
}

.search-popup form {
    position: relative;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 60px;
    padding: 10px 15px;
    display: flex;
    align-items: center;
    transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
}

.search-popup form:focus-within {
    background: rgba(255, 255, 255, 1);
    border-color: #c00415;
    box-shadow: 0 0 50px rgba(192, 4, 21, 0.3);
    transform: scale(1.02);
}

.search-popup input[type="text"] {
    background: transparent !important;
    color: #fff !important;
    font-size: 26px !important;
    font-weight: 600 !important;
    padding: 15px 30px !important;
    border: none !important;
    flex: 1;
    letter-spacing: 0.5px;
}

.search-popup form:focus-within input[type="text"] {
    color: #222 !important;
}

.search-popup .thm-btn {
    width: 60px !important;
    height: 60px !important;
    border-radius: 50% !important;
    background: #c00415 !important;
    color: #fff !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: all 0.4s ease !important;
    padding: 0 !important;
    box-shadow: 0 8px 15px rgba(192, 4, 21, 0.3) !important;
}

.search-popup .thm-btn:hover {
    transform: rotate(90deg) scale(1.1) !important;
    background: #900010 !important;
}

.search-popup .thm-btn i {
    font-size: 22px !important;
}

/* Close button enhancement */
.mobile-nav__close.search-toggler {
    font-size: 35px;
    color: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
    top: 30px;
    right: 30px;
}

.mobile-nav__close.search-toggler:hover {
    color: #c00415;
    transform: rotate(90deg);
}

.popup-tagline {
    color: #c00415;
    text-align: center;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 3px;
    margin-bottom: 20px;
    font-size: 14px;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.8s ease 0.2s;
}

.search-popup.active .popup-tagline {
    opacity: 1;
    transform: translateY(0);
}
</style>

<div class="search-popup">
    <div class="search-popup__overlay search-toggler"></div>
    <div class="search-popup__content">
        <div class="popup-tagline">Experience the future of property search</div>
        <form action="<?= SITE_URL; ?>search_result.php" method="GET" onsubmit="return checkSearchRedirect(this)">
            <input type="text" id="search" name="query" placeholder="Tell us what you're looking for..." autocomplete="off" />
            <button type="submit" aria-label="search submit" class="thm-btn">
                <i class="icon-magnifying-glass"></i>
            </button>
        </form>
    </div>
</div>

<script>
function checkSearchRedirect(form) {
    var queryField = form.querySelector('[name="query"]');
    var query = queryField ? queryField.value.trim() : '';
    if (!query) return true;

    // Phone: 5+ consecutive digits
    var digitsOnly = query.replace(/[\s\-\(\)\+]/g, '');
    var isPhone = /\d{5,}/.test(digitsOnly);

    // Email pattern
    var isEmail = /[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}/.test(query);

    if (isPhone || isEmail) {
        window.location.href = '<?= SITE_URL; ?>contact.php';
        return false;
    }
    return true;
}
</script>
<script>
    document.getElementById('search-button').addEventListener('click', function() {
        var searchBar = document.getElementById('search-bar');

        if (searchBar.style.display === "none" || searchBar.style.display === "") {
            searchBar.style.display = "block";
        } else {
            searchBar.style.display = "none";
        }
    });
</script>




<!-- Premium AI Chatbot Widget -->
<div id="a2p-chatbot">
    <!-- Chat Button -->
    <div id="chat-button" onclick="toggleChat()">
        <i class="fas fa-robot"></i>
        <span class="chat-badge">1</span>
    </div>

    <!-- Chat Window -->
    <div id="chat-window">
        <div class="chat-header">
            <div class="bot-info">
                <div class="bot-avatar">
                   <img src="<?= SITE_URL; ?>upload/<?php echo $pr_add['photo']; ?>" alt="A2P Bot">
                </div>
                <div class="bot-details">
                    <h6>A2P Assistant</h6>
                    <small>Online | Instant Response</small>
                </div>
            </div>
            <button class="close-chat" onclick="toggleChat()">&times;</button>
        </div>
        
        <div class="chat-body" id="chat-messages">
            <div class="bot-msg">
                <p>Hello! Welcome to <strong>A2P Realtech</strong>. How can I help you find your dream property today?</p>
            </div>
            <div class="bot-options">
                <button onclick="handleBotOption('buy')"><i class="fas fa-building"></i> Buy Property</button>
                <button onclick="handleBotOption('offers')"><i class="fas fa-fire"></i> Latest Offers</button>
                <button onclick="handleBotOption('location')"><i class="fas fa-map-marker-alt"></i> Search by Location</button>
                <button onclick="handleBotOption('contact')"><i class="fas fa-headset"></i> Talk to Expert</button>
            </div>
        </div>

        <div class="chat-footer">
            <input type="text" id="user-input" placeholder="Type your query..." onkeypress="handleKeyPress(event)">
            <button onclick="sendMessage()"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
</div>

<style>
/* Chat Bot Styling */
#a2p-chatbot {
    position: fixed;
    bottom: 105px; /* scroll-to-top is at bottom:40px, height:45px so = 85px + 20px gap = 105px */
    right: 20px;
    z-index: 1001;
    font-family: 'Poppins', sans-serif;
}

#chat-button {
    width: 60px;
    height: 60px;
    background: #000;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
}

#chat-button:hover {
    transform: scale(1.1) rotate(10deg);
    background: #c00415;
}

.chat-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #c00415;
    color: #fff;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    font-size: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #fff;
}

#chat-window {
    position: absolute;
    bottom: 80px;
    right: 0;
    width: 320px;
    height: 450px;
    background: #fff;
    border-radius: 15px;
    display: none;
    flex-direction: column;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.chat-header {
    background: #c00415;
    padding: 15px;
    color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.bot-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.bot-avatar img {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: #fff;
    padding: 2px;
}

.bot-details h6 { margin: 0; font-size: 14px; font-weight: 700; }
.bot-details small { font-size: 10px; opacity: 0.8; }

.close-chat {
    background: none;
    border: none;
    color: #fff;
    font-size: 24px;
    cursor: pointer;
}

.chat-body {
    flex: 1;
    padding: 15px;
    overflow-y: auto;
    background: #f9f9f9;
}

.bot-msg {
    background: #fff;
    padding: 10px 15px;
    border-radius: 12px 12px 12px 2px;
    margin-bottom: 15px;
    font-size: 13px;
    line-height: 1.5;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.user-msg {
    background: #000;
    color: #fff !important;
    padding: 10px 15px;
    border-radius: 12px 12px 2px 12px;
    margin-bottom: 15px;
    font-size: 13px;
    align-self: flex-end;
    text-align: right;
    margin-left: 20%;
}

.user-msg p {
    color: #fff !important;
}

.bot-options {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.bot-options button {
    background: #fff;
    border: 1px solid #c00415;
    color: #c00415;
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 12px;
    text-align: left;
    cursor: pointer;
    transition: all 0.2s;
}

.bot-options button:hover {
    background: #c00415;
    color: #fff;
}

.chat-footer {
    padding: 10px;
    border-top: 1px solid #eee;
    display: flex;
    gap: 5px;
}

.chat-footer input {
    flex: 1;
    border: none;
    padding: 8px 12px;
    font-size: 13px;
    outline: none;
}

.chat-footer button {
    background: #c00415;
    color: #fff;
    border: none;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    cursor: pointer;
}

/* Adjust WhatsApp Button Position */
.float-whatsapp {
    bottom: 150px !important;
}

@media (max-width: 768px) {
    #chat-window {
        width: 280px;
        height: 400px;
        right: 0;
    }
    #a2p-chatbot {
        bottom: 110px; /* Ensure clear gap above scroll-to-top on mobile */
        right: 15px;
    }
}
</style>

<script>
function toggleChat() {
    const window = document.getElementById('chat-window');
    const badge = document.querySelector('.chat-badge');
    if (window.style.display === 'flex') {
        window.style.display = 'none';
    } else {
        window.style.display = 'flex';
        badge.style.display = 'none';
    }
}

function handleBotOption(option) {
    let msg = "";
    let reply = "";
    
    if(option === 'buy') {
        msg = "I'm looking to buy a property.";
        reply = "Great choice! Do you want to search by location or property type (Residential/Commercial)?";
    } else if(option === 'offers') {
        msg = "Show me the latest offers.";
        reply = "Check out our premium projects in Gurgaon and Delhi. I'll redirect you to our top deals.";
        setTimeout(() => window.location.href = "<?= SITE_URL; ?>blog.php", 2000);
    } else if(option === 'location') {
        msg = "I want to search by location.";
        reply = "We have properties in Gurgaon, Delhi, Noida, and more. You can select your city from the 'By Location' menu in the header!";
    } else if(option === 'contact') {
        msg = "I want to talk to an agent.";
        reply = "Sure! An expert will assist you. You can call us at +91-8130525001 or drop a message on WhatsApp.";
        setTimeout(() => window.open("https://api.whatsapp.com/send?phone=918130525001", "_blank"), 2000);
    }

    addMessage(msg, 'user');
    setTimeout(() => addMessage(reply, 'bot'), 1000);
}

function addMessage(text, type) {
    const chatBody = document.getElementById('chat-messages');
    const div = document.createElement('div');
    div.className = type === 'user' ? 'user-msg' : 'bot-msg';
    div.innerHTML = `<p>${text}</p>`;
    chatBody.appendChild(div);
    chatBody.scrollTop = chatBody.scrollHeight;
}

function sendMessage() {
    const input = document.getElementById('user-input');
    const text = input.value.trim();
    if (text) {
        addMessage(text, 'user');
        input.value = '';
        setTimeout(() => {
            addMessage("Searching for '" + text + "'... Our team will get back to you with the best matches!", 'bot');
        }, 1000);
    }
}

function handleKeyPress(e) {
    if (e.key === 'Enter') sendMessage();
}
</script>


<a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>




<script src="<?= SITE_URL; ?>assets/vendors/jquery/jquery-3.6.0.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/jarallax/jarallax.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/jquery-appear/jquery.appear.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/jquery-validate/jquery.validate.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/nouislider/nouislider.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/odometer/odometer.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/swiper/swiper.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/tiny-slider/tiny-slider.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/wnumb/wNumb.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/wow/wow.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/isotope/isotope.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/countdown/countdown.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/bxslider/jquery.bxslider.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/vegas/vegas.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/jquery-ui/jquery-ui.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/timepicker/timePicker.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/circleType/jquery.circleType.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/circleType/jquery.lettering.min.js"></script>


<script src="<?= SITE_URL; ?>assets/js/ambed.js"></script>

<script src="<?= SITE_URL; ?>assets/vendors/toolbar/js/js.cookie.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/toolbar/js/jQuery.style.switcher.min.js"></script>
<script src="<?= SITE_URL; ?>assets/vendors/toolbar/js/toolbar.js"></script>

</body>


</html>