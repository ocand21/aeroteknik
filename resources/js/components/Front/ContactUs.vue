<template>
<div :id="contactUs.slug">
    <section id="contact" class="wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
      <div class="container">
        <div class="section-header">
          <h2>{{contactUs.judul}}</h2>
          <div v-html="contactUs.isi"></div>
        </div>

        <div class="row contact-info">

          <div class="col-md-6">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Sales & Marketing</h3>
              <address>
                  <p>3rd Floor, Renmark Building.</p>
                  <p>Jl. Mayjen Sutoyo 25, Semarang, Jawa Tengah - INDONESIA</p>
              </address>
              <p><a href="tel:+0248503663">+024 850 3363</a></p>
            </div>
          </div>

          <div class="col-md-6">
            <div class="contact-phone">
              <i class="ion-ios-location-outline"></i>
              <h3>Workshop</h3>
              <address>
                  Jl. Sesabuk RT 002 RW 003 Gilingsari, Temanggung, Jawa Tengah - INDONESIA
              </address>
            </div>
          </div>

        </div>
      </div>

      <div class="container mb-4">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15840.783537455898!2d110.4245266!3d-6.9861921!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xccd85d59140eb4bf!2sRENMARK%20BUILDING!5e0!3m2!1sid!2sid!4v1574843250545!5m2!1sid!2sid" width="100%" height="380" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
      </div>

      <div class="container">
        <div class="form">
          <div id="sendmessage">Your message has been sent. Thank you!</div>
          <div id="errormessage"></div>
          <form action="" method="post" role="form" class="contactForm">
            <div class="form-row">
              <div class="form-group col-md-4">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-4">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email">
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-4">
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Your Phone" data-rule="phone" data-msg="Please enter a valid email">
                <div class="validation"></div>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject">
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
              <div class="validation"></div>
            </div>
            <div class="text-center"><button class="btn" type="submit">Send Message</button></div>
          </form>
        </div>

      </div>
    </section>
</div>
</template>

<script>
export default {
    data(){
        return {
            contactUs: [],
            form: new Form({
                name: '',
                email: '',
                phone: '',
                subjek: '',
                pesan: '',
            }),
        }
    },
    methods: {
        loadData(){
            axios.get('/api/front/halaman/contact-us').then(({
                data
            }) => (this.contactUs = data));
        }
    },
    created() {
        this.$Progress.start();
        this.loadData();
        this.$Progress.finish();
        // console.log('Component mounted.')
    }
}
</script>
