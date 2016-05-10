<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets'); ?>/css/style.css">
</head>
<body>
  <hgroup>
    <h1>Sarang Sharing Login</h1>
  </hgroup>
  <form>
    <div class="group">
      <input type="text"><span class="highlight"></span><span class="bar"></span>
      <label>Username</label>
    </div>
    <div class="group">
      <input type="password"><span class="highlight"></span><span class="bar"></span>
      <label>Password</label>
    </div>
    <button type="button" class="button buttonBlue">Login
      <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
    </button>
  </form>
</body>

<script type="text/javascript">
$(window, document, undefined).ready(function() {

  $('input').blur(function() {
    var $this = $(this);
    if ($this.val())
      $this.addClass('used');
    else
      $this.removeClass('used');
  });

  var $ripples = $('.ripples');

  $ripples.on('click.Ripples', function(e) {

    var $this = $(this);
    var $offset = $this.parent().offset();
    var $circle = $this.find('.ripplesCircle');

    var x = e.pageX - $offset.left;
    var y = e.pageY - $offset.top;

    $circle.css({
      top: y + 'px',
      left: x + 'px'
    });

    $this.addClass('is-active');

  });

  $ripples.on('animationend webkitAnimationEnd mozAnimationEnd oanimationend MSAnimationEnd', function(e) {
    $(this).removeClass('is-active');
  });

});
</script>