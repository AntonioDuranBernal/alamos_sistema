const modeVerify = "authentication";
const modeCapture = "enrollment";
const currentFormat = Fingerprint.SampleFormat.Intermediate;
const linkDownloadDirectSDK = "https://www.crossmatch.com/AltusFiles/AltusLite/digitalPersonaClient.Setup64.exe";
const ENDPOINT = "http://localhost:5000/api/";
var listFingers = [];
const limitFingerRegister = 4;

// console.log("INDEX EXECUTE");

let btnAuth = document.getElementById('digital-authentication');
let btnEnrollment = document.getElementById('digital-enrollment');

var fingerprintReader = null;

if(btnAuth){
    btnAuth.addEventListener('click', () => {
        modeReader = modeVerify;
        if(fingerprintReader)
            fingerprintReader.startCapture();
        else {
            fingerprintReader = new FingerprintSdkTest();
            fingerprintReader.startCapture();
        }
        
        presentAlert(true)
    });
}

if(btnEnrollment) {
    btnEnrollment.addEventListener('click', () => {
        modeReader = modeCapture;
        if(fingerprintReader)
            fingerprintReader.startCapture();
        else {
            fingerprintReader = new FingerprintSdkTest();
            fingerprintReader.startCapture();
        }
        
        presentAlert(true);
    });
}

let FingerprintSdkTest = (function () {
    function FingerprintSdkTest() {
        let _instance = this;
        this.operationToRestart = null;
        this.acquisitionStarted = false;
        // instantiating the fingerprint sdk here
        this.sdk = new Fingerprint.WebApi;
        this.sdk.onDeviceConnected = function (e) {
            // Detects if the device is connected for which acquisition started
            console.log("Scan Appropriate Finger on the Reader", "success");
        };
        this.sdk.onDeviceDisconnected = function (e) {
            // Detects if device gets disconnected - provides deviceUid of disconnected device
            console.log("Device is Disconnected. Please Connect Back");
        };
        this.sdk.onCommunicationFailed = function (e) {
            // Detects if there is a failure in communicating with U.R.U web SDK

            console.log("Communication Failed. Please Reconnect Device");
            console.log("Descarga el SDK", linkDownloadDirectSDK);
        };
        this.sdk.onSamplesAcquired = function (s) {
            // Sample acquired event triggers this function
            sendSample(s);
        };
        this.sdk.onQualityReported = function (e) {
            console.log("onQualityReported", e);
            // Quality of sample acquired - Function triggered on every sample acquired
            //document.getElementById("qualityInputBox").value = Fingerprint.QualityCode[(e.quality)];
        }
    }


    // this is were finger print capture takes place
    FingerprintSdkTest.prototype.startCapture = function () {
        if (this.acquisitionStarted) // Monitoring if already started capturing
            return;
        let _instance = this;
        console.log("");
        this.operationToRestart = this.startCapture;
        this.sdk.startAcquisition(currentFormat).then(function () {
            _instance.acquisitionStarted = true;

            //Disabling start once started
            //disableEnableStartStop();

        }, function (error) {
            console.log(error.message);
        });
    };
    
    FingerprintSdkTest.prototype.stopCapture = function () {
        if (!this.acquisitionStarted) //Monitor if already stopped capturing
            return;
        let _instance = this;
        this.sdk.stopAcquisition().then(function () {
            _instance.acquisitionStarted = false;

            //Disabling stop once stopped
            //disableEnableStartStop();

        }, function (error) {
            console.log(error.message);
        });
    };

    FingerprintSdkTest.prototype.getInfo = function () {
        let _instance = this;
        return this.sdk.enumerateDevices();
    };

    FingerprintSdkTest.prototype.getDeviceInfoWithID = function (uid) {
        let _instance = this;
        return  this.sdk.getDeviceInfo(uid);
    };
    
    return FingerprintSdkTest;
})();


function sendSample(sample){
    // alert("Enviar datos modo registro");
    console.log(sample);
    let samples = JSON.parse(sample.samples);
    let sampleData = samples[0].Data;

 
    if(modeReader === modeCapture){
        listFingers.push(sampleData);

        const containerImg = document.getElementById("container-img");
        const img = document.createElement('img');
        img.src = 'imagenes/huella.png';
        img.classList.add('w-32')
        containerImg.appendChild(img);

        if(listFingers.length < limitFingerRegister) {
            return;
        }

        const optionsCapture = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(listFingers)
        } 
        
        fetch(`${ENDPOINT}FingerprintReader/register`, optionsCapture)
        .then(response => response.text())
        .then(data => {
            console.log(data);

            const inputHuella = document.getElementById('huella');
            inputHuella.value = data;
            fingerprintReader.stopCapture();
            listFingers = [];

            btnEnrollment.classList.add('hidden');
            presentAlert(false);
            
            // while (containerImg.firstChild) {
            //     containerImg.removeChild(containerImg.firstChild);
            // }
        })
        .catch(error => {
            console.error('Error', error);
            fingerprintReader.stopCapture();
            listFingers = [];
            presentAlert(false);

            // while (containerImg.firstChild) {
            //     containerImg.removeChild(containerImg.firstChild);
            // }
        });


    }else if(modeReader === modeVerify) {

        const optionsVerify = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify([sampleData])
        }

        fetch(`${ENDPOINT}FingerprintReader/find`, optionsVerify)
        .then(response => response.json())
        .then(data => {
            // console.log(data);
            const { idUsuarioSistema, password, nombre, apellidos } = data;

            if(idUsuarioSistema == 0){
                alert("Usuario no Encontrado");
            } else {
                if(confirm(`${nombre} ${apellidos} Deseas Continuar`)){
                    const formFinger = document.getElementById('formFinger');
                    const password2 = document.getElementById('password2');
                    const id = document.getElementById('id');

                    password2.value = password;
                    id.value = idUsuarioSistema;

                    formFinger.submit();
                } 
            }

            fingerprintReader.stopCapture();
            presentAlert(false);
        })
        .catch(error => {
            console.error('Error', error)
            fingerprintReader.stopCapture();
            presentAlert(false);
        });    
    
    }else
        console.log("Valor modereader No inicializado");

    
}

function presentAlert(status){
    const alert = document.getElementById('alert-fingerprint');
    if(!alert) return;

    if(status){
        alert.classList.remove('hidden');
        alert.classList.add('show')
    }else {
        alert.classList.remove('show');
        alert.classList.add('hidden')
    }
}