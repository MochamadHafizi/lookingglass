window.speedtest = function(opts) {
    const defaults = {
      maxTime: 5000
    };
    const options = Object.assign({}, defaults, opts);
  
    return new Promise((resolve, reject) => {
      const startTime = new Date();
      const image = new Image();
  
      image.onload = () => {
        const endTime = new Date();
        const timeDiff = endTime - startTime;
        const bitsLoaded = image.width * image.height * 8;
        const speedBps = (bitsLoaded / timeDiff) * 1000;
        const speedKbps = speedBps / 1024;
        const speedMbps = speedKbps / 1024;
  
        resolve({
          download: speedMbps
        });
      };
  
      image.onerror = () => {
        reject(new Error('Failed to load image.'));
      };
  
      const cacheBuster = '?cachebust=' + new Date().getTime();
      image.src = 'https://cdn.pixabay.com/photo/2020/05/05/07/17/sun-5137870_1280.jpg' + cacheBuster;
  
      setTimeout(() => {
        reject(new Error('Speedtest timed out.'));
      }, options.maxTime);
    });
  };
  