<!-- Contact Form -->
<section class="form-section" id="callback">
  <div class="container">
    <h2 class="section-title text-center">Оставить заявку</h2>
    <p class="section-subtitle text-center">Заполните форму и мы свяжемся с вами в ближайшее время</p>
    <div class="form-wrapper">
      <?php
      /**
       * Contact Form 7 shortcode.
       * After installing CF7, create a form with the following template and paste its shortcode below.
       *
       * CF7 Form Template:
       * <div class="form-grid">
       *   <div class="form-group">
       *     <label class="form-label">Имя *</label>
       *     [text* your-name class:form-input placeholder "Ваше имя"]
       *   </div>
       *   <div class="form-group">
       *     <label class="form-label">Телефон *</label>
       *     [tel* your-phone class:form-input placeholder "+375 (44) 584-10-91"]
       *   </div>
       *   <div class="form-group">
       *     <label class="form-label">Email</label>
       *     [email your-email class:form-input placeholder "example@mail.com"]
       *   </div>
       *   <div class="form-group">
       *     <label class="form-label">Интересующая услуга</label>
       *     [select service class:form-select include_blank "Выберите услугу" "Аренда башенного крана" "Аренда автомобильного крана" "Аренда гусеничного крана" "Монтаж и проектирование"]
       *   </div>
       *   <div class="form-group form-group--full">
       *     <label class="form-label">Комментарий</label>
       *     [textarea your-message class:form-input placeholder "Опишите ваш проект или задайте вопрос"]
       *   </div>
       *   <div class="form-group form-group--full">
       *     [submit class:btn class:btn--primary class:btn--lg class:btn--full "Отправить заявку"]
       *     <p class="form-note">Нажимая кнопку, вы соглашаетесь с политикой конфиденциальности</p>
       *   </div>
       * </div>
       */
      if ( shortcode_exists( 'contact-form-7' ) ) {
          // Replace 123 with your actual CF7 form ID after creating the form
          echo do_shortcode( '[contact-form-7 id="123" title="Заявка с сайта"]' );
      } else {
          // Fallback form if CF7 is not installed
      ?>
      <form id="contactForm">
        <div class="form-grid">
          <div class="form-group">
            <label class="form-label">Имя *</label>
            <input type="text" class="form-input" placeholder="Ваше имя" required>
          </div>
          <div class="form-group">
            <label class="form-label">Телефон *</label>
            <input type="tel" class="form-input" placeholder="+375 (44) 584-10-91" required>
          </div>
          <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" class="form-input" placeholder="example@mail.com">
          </div>
          <div class="form-group">
            <label class="form-label">Интересующая услуга</label>
            <select class="form-select">
              <option value="">Выберите услугу</option>
              <option>Аренда башенного крана</option>
              <option>Аренда автомобильного крана</option>
              <option>Аренда гусеничного крана</option>
              <option>Монтаж и проектирование</option>
            </select>
          </div>
          <div class="form-group form-group--full">
            <label class="form-label">Комментарий</label>
            <textarea class="form-input" placeholder="Опишите ваш проект или задайте вопрос"></textarea>
          </div>
          <div class="form-group form-group--full">
            <button type="submit" class="btn btn--primary btn--lg btn--full">Отправить заявку</button>
            <p class="form-note">Нажимая кнопку, вы соглашаетесь с политикой конфиденциальности</p>
          </div>
        </div>
      </form>
      <?php } ?>
    </div>
  </div>
</section>
