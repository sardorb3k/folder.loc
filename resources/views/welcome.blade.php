<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">
  <head>
    <meta charset="utf-8" />
    <title>Luna University</title>
    <meta
      name="description"
      content="Luna Universiteti - O'zbekistondagi birinchi diplomsiz o'rganish, o'rgatish, izlanish va global miqyosda o'zgarishlarni amalga oshiradigan baxtli insonlar uchun."
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Luna University" />
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon" />
    <link id="feuille" rel="stylesheet" href="css/style-electric.css" />
  </head>
  <body>
    <canvas id="constellationel"></canvas>
    <div id="constellation"></div>
    <span class="full-overlay"></span>
    <div id="loading">
      <div class="loader">
        <div class="loader__row">
          <div class="loader__arrow up inner inner-6"></div>
          <div class="loader__arrow down inner inner-5"></div>
          <div class="loader__arrow up inner inner-4"></div>
        </div>
        <div class="loader__row">
          <div class="loader__arrow down inner inner-1"></div>
          <div class="loader__arrow up inner inner-2"></div>
          <div class="loader__arrow down inner inner-3"></div>
        </div>
      </div>
      <span>LUNA</span>
    </div>
    <div id="fullpage">
      <div class="section active" id="section0">
        <div class="inside-section">
          <div class="inside-content">
            <img src="img/luna-logo.png" class="brand-logo" alt="My logo" />
            <h1 class="cd-headline zoom">
              <span class="cd-words-wrapper"
                ><b class="is-visible">
                  Hayot Tarzingizda<br />
                  Kichik
                  <span class="highlight">O'zgarishlar</span>
                  <br />
                  Qilishmi </b
                ><b
                  >Insonlarga <br />
                  Ozgina
                  <span class="highlight">G'amxo'rlik</span><br />
                  Qilishmi </b
                ><b>
                  <span class="highlight">Luna Universiteti </span> <br />
                  sizga bu borada<br />
                  yordam beradi!
                </b></span
              >
            </h1>
            <div class="text">
              <h2 class="home-h2">
                1-Sentabrdan Luna Universitetining baxtli a'zosi bo'ling
              </h2>
            </div>
          </div>
        </div>
        <a class="ibtn light-btn blink" href="#2">A'zo bo'lish!</a>
      </div>
      <div class="section" id="section1">
        <div class="inside-section">
          <div class="inside-content double-col container">
            <div class="row">
              <div class="col-xs-12 col-md-6 col-lg-5 with-border">
                <h2>
                  1<span class="number">.</span> O'qing<small
                    >Ushbu ajoyib universitetning bir qismi bo'lish bu -</small
                  >
                </h2>
                <div class="text">
                  <p class="subtitle">
                    Ajoyib ko'nikmalarni o'rganish, o'rgatish, izlanish va
                    global miqyosdagi o'zgarishlarni amalga oshiradigan baxtli
                    inson bo'lish demakdir.<br /><br /><strong
                      >Insonlarning bilimga bo'lgan muhabbatini
                      uyg'otish</strong
                    >
                    eng asosiy maqsadlarimizdan biridir.
                  </p>
                </div>
              </div>
              <div
                class="col-xs-12 col-md-6 col-md-push-0 col-lg-6 col-lg-push-1"
              >
                <h2>
                  2<span class="number">.</span> A'zo bo'ling<small
                    >Ajoyib o'zgarishlarni amalga oshiring</small
                  >
                </h2>
                <div class="text">
                  <ul>
                    <li>
                      <i class="fa fa-check"></i> Ajoyib ko'nikmalarni hosil
                      qiling
                    </li>
                    <li>
                      <i class="fa fa-check"></i> Ajoyib imkoniyatlarni kashf
                      eting
                    </li>
                    <li>
                      <i class="fa fa-check"></i> Ajoyib do'stlar orttiring
                    </li>
                  </ul>
                  <div id="subscribe">
                    <form action="#" id="notifyMe" method="POST">
                      <div class="form-group">
                        <div class="controls">
                          <input
                            type="text"
                            id="mail-sub"
                            name="phone"
                            placeholder="Telefon raqamingizni kiriting"
                            onfocus="this.placeholder = ''"
                            onblur="this.placeholder = 'Telefon raqamingizni kiriting'"
                            class="form-control email srequiredField"
                          />
                          <button id="submit-form" class="btn btn-lg submit">
                            A'zo bo'lish
                          </button>
                          <div class="clear"></div>
                        </div>
                      </div>
                    </form>
                    <p class="spam-news">
                      <i class="fa fa-lock"></i> Sizning telefon raqamingiz
                      maxfiy qoladi.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <a class="ibtn light-btn hidden-xs hidden-sm" href="#3"
          >Biz bilan bog'laning!</a
        >
      </div>
      <div class="section" id="section2">
        <div class="inside-section">
          <div class="inside-content container">
            <h2>
              Salom!<small>Sizning xabaringizni intiqlik bilan kutamiz.</small>
            </h2>
            <div class="text">
              <form
                id="contact-form"
                name="contact-form"
                method="POST"
                data-name="Contact Form"
              >
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-lg-12 display-none">
                    <div class="form-group">
                      <input
                        type="text"
                        id="checking"
                        class="form form-control"
                        placeholder="Leave this field empty"
                        onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Leave this field empty'"
                        name="checking"
                        data-name="Checking"
                      />
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-lg-12">
                    <div class="form-group">
                      <i class="fa fa-user icon-fields"></i>
                      <input
                        type="text"
                        id="name"
                        class="form form-control"
                        placeholder="Ismingiz*"
                        onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Ismingiz*'"
                        name="name"
                        data-name="Ismingiz"
                        required
                      />
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-lg-12">
                    <div class="form-group">
                      <i class="fa fa-phone icon-fields"></i>
                      <input
                        type="phone"
                        id="phone"
                        class="form form-control"
                        placeholder="Telefon raqamingiz*"
                        onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Telefon raqamingiz*'"
                        name="phone-number"
                        data-name="Telefon raqamingiz"
                        required
                      />
                    </div>
                  </div>
                  <!-- <div class="col-xs-12 col-sm-12 col-lg-12">
                    <div class="form-group form-group-select">
                      <i class="fa fa-commenting icon-fields"></i>
                      <select
                        id="reason"
                        class="form form-control no-selection"
                        name="reason"
                        data-name="reason"
                        onchange="selectedfield()"
                      >
                        <option value="placeholder" disabled selected>
                          Regarding...*
                        </option>
                        <option value="Enterprise Sales">
                          Enterprise Sales
                        </option>
                        <option value="Customer Support and Billing">
                          Customer Support &amp; Billing
                        </option>
                        <option value="Recruiting">Recruiting</option>
                        <option value="Just saying Hi!">Just saying Hi!</option>
                      </select>
                    </div>
                  </div> -->
                  <div class="col-xs-12 col-sm-12 col-lg-12">
                    <div class="form-group">
                      <i class="fa fa-pencil icon-fields"></i
                      ><textarea
                        id="text-area"
                        class="form textarea form-control"
                        placeholder="Xabaringiz*..."
                        onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Your message here*... 20 characters Min.'"
                        name="message"
                        data-name="Text Area"
                        required
                      ></textarea>
                    </div>
                    <span class="sub-text">* majburiy</span>
                  </div>
                  <div class="col-xs-12 col-sm-12 col-lg-12">
                    <input
                      type="checkbox"
                      id="ios"
                      name="newsletter"
                      value="Yes"
                      checked
                    />
                    <label for="ios" class="ios button"></label>
                    <label class="check-news"
                      >Haftalik yangiliklardan xabardor bo'lmoqchiman.</label
                    >
                  </div>
                </div>
                <button type="submit" id="valid-form" class="btn btn-color">
                  Bizga xabar yozing!
                </button>
              </form>
            </div>
          </div>
        </div>
        <a class="ibtn light-btn back-home hidden-xs hidden-sm" href="#1"
          ><i class="fa fa-home"></i
        ></a>
      </div>
    </div>
    <div id="block-answer" class=""><div id="answer"></div></div>
    <div class="block-message">
      <div class="message"><p class="notify-valid"></p></div>
    </div>
    <div class="social-nav">
      <ul>
        <li>
          <a href="https://t.me/luna_university" target="_blank"
            ><i class="fa fa-paper-plane"></i
          ></a>
        </li>
        <li>
          <a
            href="https://www.youtube.com/channel/UCJFA7M2SnvbWIeC68oXunNg"
            target="_blank"
            ><i class="fa fa-youtube-play"></i
          ></a>
        </li>
        <li>
          <a href="https://www.instagram.com/luna_university/" target="_blank"
            ><i class="fa fa-instagram"></i
          ></a>
        </li>
      </ul>
    </div>
    <div class="copyright">
      <p>
        <strong>Luna University</strong><br />
        Ishtixon, Samarqand<br />
        <a href="https://lunauni.uz" target="_blank">Luna University</a> © 2022
      </p>
    </div>
    <script src="js/jquery/jquery-1.12.4.min.js"></script>
    <script src="js/jquery/jquery.easing.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/jquery.fullpage.js"></script>
    <script src="js/contact-me.js"></script>
    <script src="js/notifyMe.js"></script>
    <script src="js/constellation.js"></script>
    <script src="js/animated-headlines.js"></script>
    <script src="js/main.js"></script>
    <script>
      (function (d, e, j, h, f, c, b) {
        d.GoogleAnalyticsObject = f;
        (d[f] =
          d[f] ||
          function () {
            (d[f].q = d[f].q || []).push(arguments);
          }),
          (d[f].l = 1 * new Date());
        (c = e.createElement(j)), (b = e.getElementsByTagName(j)[0]);
        c.async = 1;
        c.src = h;
        b.parentNode.insertBefore(c, b);
      })(window, document, "script", "js/google/analytics.js", "ga");
      ga("create", "UA-60503361-1", "auto");
      ga("send", "pageview");
    </script>
  </body>
</html>
