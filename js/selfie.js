(function() {
    var streaming		= false,
        video			= document.querySelector('#video'),
        canvas			= document.querySelector('#canvas'),
        selfie			= document.querySelector('#selfie'),
        picture_btn		= document.querySelector('#picture_btn'),
        img			    = document.querySelector('#img'),
        width			= 320,
        height			= 0;
    navigator.getMedia	= ( navigator.getUserMedia ||
                        navigator.webkitGetUserMedia ||
                        navigator.mozGetUserMedia ||
                        navigator.msGetUserMedia);
    navigator.getMedia({
            video: true,
            audio: false
        },
        function(stream) {
            if (navigator.mozGetUserMedia) {
                video.mozSrcObject = stream;
            } else {
                var vendorURL = window.URL || window.webkitURL;
                video.src = vendorURL.createObjectURL(stream);
            }
            video.play();
        },
        function(err) {
            console.log("An error occured! " + err);
        }
    );
    video.addEventListener('canplay', function(ev){
        if (!streaming) {
            height = video.videoHeight / (video.videoWidth/width);
            video.setAttribute('width', width);
            video.setAttribute('height', height);
            canvas.setAttribute('width', width);
            canvas.setAttribute('height', height);
            streaming = true;
        }
    }, false);
    picture_btn.addEventListener('click', function(ev){
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);
        var data = canvas.toDataURL('image/png');
        selfie.setAttribute('src', data);
        img.setAttribute('value', data);
    }, false);
})();

function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
    oFReader.onload = function (oFREvent) {
        document.getElementById("selfie").src = oFREvent.target.result;
    };
};

function EnableButton() {
    document.getElementById('btn-submit').disabled = false;
}