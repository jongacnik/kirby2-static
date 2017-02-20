<div class="text">
  <div class="dashboard-box">
    <div class="text">Dope</div>
  </div>
  <p>Click <b>Statify</b> to generate a static version of your site.</p>
  <fieldset class="fieldset buttons buttons-centered">
    <button class="btn btn-rounded btn-submit" id="kirby-static">Statify</button>
  </fieldset>
</div>

<script>
var bttn = document.getElementById('kirby-static')
var route = "<?php echo $route ?>";

var publish = function () {
  setBttnState('loading')

  var request = new XMLHttpRequest()
  request.open('GET', route, true)

  request.onload = function() {
    if (request.status >= 200 && request.status < 400) {
      setBttnState('done')
      setTimeout(function () {
        setBttnState(false)
      }, 2000)
    } else { }
  }

  request.onerror = function() { }
  request.send()
}
var setBttnState = function (state) {
  if (state === 'loading') {
    bttn.innerHTML = 'Loading...'
    bttn.style.pointerEvents = 'none'
    bttn.setAttribute('disabled', 'disabled')
  } else if (state === 'done') {
    bttn.innerHTML = 'Done!'
    bttn.style.pointerEvents = 'auto'
    bttn.removeAttribute('disabled')
  } else {
    bttn.innerHTML = 'Statify'
    bttn.style.pointerEvents = 'auto'
    bttn.removeAttribute('disabled')
  }
}
bttn.addEventListener('click', publish)
</script>
