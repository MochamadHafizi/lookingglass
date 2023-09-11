@extends('layouts/app')
@section('content')
<style>
    * Wrapper */
div#wrapper {
  width: 400px;
  margin: 1.3em auto;
  margin-top: 1.3em;
  padding: 0.75em 0.75em;
  background: #fff;
  border: 1px solid #5e5e5e;
  border-radius: 5px;
  box-shadow: 0px 0px 4px #ffffffc2;
  margin-bottom: 1em;
}

/* Loader */
#loader{
  width: 100%;
  display: none;
  justify-content: center;
}
#loader .lds-ripple {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
#loader .lds-ripple div {
  position: absolute;
  border: 4px solid #3c3b3b;
  opacity: 1;
  border-radius: 50%;
  animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
}
#loader .lds-ripple div:nth-child(2) {
  animation-delay: -0.5s;
}
@keyframes lds-ripple {
  0% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 0;
  }
  4.9% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 0;
  }
  5% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 1;
  }
  100% {
    top: 0px;
    left: 0px;
    width: 72px;
    height: 72px;
    opacity: 0;
  }
}

/* Network Resul Title */
div#netword-speed-title {
  text-align: center;
  font-size: 0.90rem;
  font-weight: 400;
  color: #383737;
}

/* Network Speed Result Wrapper */
div#network-speeds {
  position: relative;
  width: 100%;
  /* display: flex;
  justify-content: space-evenly; */
}

.speed {
  /* width: 33%; */
  padding: 0.35em 0.75em;
}

.speed:has(~ .speed) {
  border-bottom: 1px solid #e1e1e1;
}

.speed-label {
  text-align: center;
  font-size: 0.75rem;
  letter-spacing: 1px;
  color: #5e5959;
}

.speed #bits-speed,
.speed #kbps-speed,
.speed #mbps-speed,
.speed #ping-speed,
.speed #upload-speed{
  text-align: center;
  font-size: 1rem;
  color: #141414;
  font-weight: 400;
  letter-spacing: 1.5px;
  padding: 0.35em 0.75em;
  overflow-wrap:anywhere;
}

button#detect-speed {
  margin: 0.75em auto;
  display: block;
  padding: 0.35em 0.75em;
  outline: none;
  background: #ffa600;
  border: 1px solid #ffa600;
  box-shadow: 0px 0px 5px #ffa600;
  color: #fff;
  font-weight: 600;
  cursor: pointer;

}

button#detect-speed:hover,
button#detect-speed:focus{
  background: #ffa600;
  border: 1px solid #ffa600;
  box-shadow: 0px 0px 5px #ffa600;
}

button#detect-speed[disabled] {
  filter: brightness(0.9);
  pointer-events: none;
  cursor: not-allowed;
}
</style>
<section>
  <div class="flex justify-center mt-28">	
    <div id="wrapper">
      <div id="loader">
        <div class="lds-ripple"><div></div><div></div></div>
      </div>
      <div id="netword-speed-title">Network Speed Result</div>
      <div id="network-speeds">
        <div class="speed">
          <div class="speed-label">Bits</div>
          <div id="bits-speed">0</div>
        </div>
        <div class="speed">
          <div class="speed-label">Kbps</div>
          <div id="kbps-speed">0</div>
        </div>
        <div class="speed">
          <div class="speed-label">Mbps</div>
          <div id="mbps-speed">0</div>
        </div>
      </div>
      <div id="network-ping">
        <div class="speed">
          <div class="speed-label">Ping</div>
          <div id="ping-speed">0</div>
        </div>
      </div>
      <div id="network-upload">
        <div class="speed">
          <div class="speed-label">Upload</div>
          <div id="upload-speed">0</div>
        </div>
      </div>
      <div>
        <button id="detect-speed" class="text-sm">Check Network Speed</button>
      </div>
    </div>
  </div>
</section>

<script>
  // Loader slector
const loaderEl = document.getElementById('loader')
// button slector
const detectSpeedBtn = document.getElementById('detect-speed')
// bits text container slector
const bitsEl = document.getElementById('bits-speed')
// kbps text container slector
const kbpsEl = document.getElementById('kbps-speed')
// mbps text container slector
const mbpsEl = document.getElementById('mbps-speed')

// Source of an image to load to check the speed
let imageSrc = "https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/132C_trans.gif/230px-132C_trans.gif?time="+ (new Date().getTime());

detectSpeedBtn.addEventListener('click', e => {
    // prevent default
    e.preventDefault
    var bits = 0;
    var kbps = 0;
    var mbps = 0;
    var starTime = 0;
    var endTime = 0;
    detectSpeedBtn.disabled = true
    loaderEl.style.display = `flex`

    var img = new Image()
    img.crossOrigin = ''
    var imgSize = 0;

    starTime = new Date().getTime();
    img.src = imageSrc

    img.onload = async ()=>{
        endTime = new Date().getTime()

        // Wait for the image link response and get image size
        await fetch(imageSrc)
        .then(response => {
            imgSize = response.headers.get("content-length")
            console.log(imgSize)
            var timeDiff = (endTime - starTime) / 1000;
            var loadedImgSizeInBits = imgSize * 8;
            bits = (loadedImgSizeInBits / timeDiff)
            kbps = (bits / 1024)
            mbps = (kbps / 1024)
            return
        })
        .then( () =>{
            var tmpBits = 0;
            var tmpKb = 0;
            var tmpMb = 0;
            // Animating the network result
            function animate(){
                if(tmpBits < bits || tmpKb < kbps || tmpMb < mbps){
                    bitsEl.innerText = tmpBits.toLocaleString('en-US',{style:'decimal', maximumFractionDigits:2})
                    kbpsEl.innerText = tmpKb.toLocaleString('en-US',{style:'decimal', maximumFractionDigits:2})
                    mbpsEl.innerText = tmpMb.toLocaleString('en-US',{style:'decimal', maximumFractionDigits:2})
                    tmpBits = tmpBits + (bits  / 20);
                    tmpKb = tmpKb + (kbps  / 20);
                    tmpMb = tmpMb + (mbps  / 20);
                    setTimeout(animate, 30)
                }else{
                    bitsEl.innerText = bits.toLocaleString('en-US',{style:'decimal', maximumFractionDigits:2})
                    kbpsEl.innerText = kbps.toLocaleString('en-US',{style:'decimal', maximumFractionDigits:2})
                    mbpsEl.innerText = mbps.toLocaleString('en-US',{style:'decimal', maximumFractionDigits:2})
                    detectSpeedBtn.disabled = false
                    detectSpeedBtn.innerText = `Re-Check Network Speed`
                    loaderEl.style.display = `none`
                }
            }
            animate()
        })
    }
})
</script>
@endsection