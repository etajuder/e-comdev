<div class="carousel slide" data-ride="carousel" id="quote-carousel">
	<!-- Bottom Carousel Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
		<li data-target="#quote-carousel" data-slide-to="1"></li>
		<li data-target="#quote-carousel" data-slide-to="2"></li>
	</ol>
        
        <!-- Carousel Slides / Quotes -->
        <div class="carousel-inner">
        
          <!-- Quote 1 -->
          <div class="item active">
            <blockquote>
              <div class="row">
                <div class="col-xs-3 col-sm-2 text-center">
                  <img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg" style="width: 80px;height:80px;">
                </div>
                <div class="col-xs-9 col-sm-10">
                  <p><i class="ion-chatbubble"></i> Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit!</p>
                  <small>Someone famous</small>
                </div>
              </div>
            </blockquote>
          </div>
          <!-- Quote 2 -->
          <div class="item">
            <blockquote>
              <div class="row">
                <div class="col-xs-3 col-sm-2 text-center">
                  <img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/mijustin/128.jpg" style="width: 80px;height:80px;">
                </div>
                <div class="col-xs-9 col-sm-10">
                  <p><i class="ion-chatbubble"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam auctor nec lacus ut tempor. Mauris.</p>
                  <small>Someone famous</small>
                </div>
              </div>
            </blockquote>
          </div>
          <!-- Quote 3 -->
          <div class="item">
            <blockquote>
              <div class="row">
                <div class="col-xs-3 col-sm-2 text-center">
                  <img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/keizgoesboom/128.jpg" style="width: 80px;height:80px;">
                </div>
                <div class="col-xs-9 col-sm-10">
                  <p><i class="ion-chatbubble"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut rutrum elit in arcu blandit, eget pretium nisl accumsan. Sed ultricies commodo tortor, eu pretium mauris.</p>
                  <small>Someone famous</small>
                </div>
              </div>
            </blockquote>
          </div>
        </div>
      </div>  
	 
<script>
	$(document).ready(function() {
	  //Set the carousel options
	  $('#quote-carousel').carousel({
		pause: true,
		interval: 4000,
	  });
	});
</script>