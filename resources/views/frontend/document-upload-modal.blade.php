<div class="modal fade" id="document-upload-modal" tabindex="-1" aria-labelledby="documentsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form onsubmit="onSubmitHandle(event)" id="submit-form" class="modal-content"
            action="{{ route('document.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="modal-header" style="background-color: #1A1D23; color: white; border-radius: 1px;">
                <h1 class="modal-title fs-4 text-white text-capitalize" id="documentsModalLabel">choose your
                    document
                    type</h1>
                <button type="button" class="btn-close btn-white text-danger" style="" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body pt-4" style="background-color: #1A1D23; color: white; ">
                <div class="document-type">
                    <div class="form-check">
                        <input class="form-check-input" type="radio"
                            onchange="onChangeDocumentTypes(event.target.value)" name="document_type" id="id-card"
                            value="ID Card">
                        <label class="form-check-label" for="id-card">
                            ID Card
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"
                            onchange="onChangeDocumentTypes(event.target.value)" name="document_type" id="passport"
                            value="Passport">
                        <label class="form-check-label" for="passport">
                            Passport
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio"
                            onchange="onChangeDocumentTypes(event.target.value)" name="document_type"
                            id="driver-license" value="Driver license">
                        <label class="form-check-label" for="driver-license">
                            Driver's license
                        </label>
                    </div>
                </div>
                <div id="documents" class=" d-none pt-3">
                    <h6 class="text-white">Take a photo of your <span id="document-type-name"></span></h6>
                    <div>
                        <div class="form-group">
                            <label><span id="label-front"></span> Front Site</label>
                            <div id="preview-front"
                                class="w-full rounded-4 d-flex justify-content-center align-items-center"
                                style="height: 200px; border: 2px dotted #2980B9;" onclick="uploadDocumentFront()">
                                <div class=" text-center" id="document-front-upload-text-centent">
                                    {{-- <span class="text-white fs-3">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </span> --}}
                                    <h5 class="text-white">Upload the <b class=" text-info">front</b> of your
                                        document
                                    </h5>
                                </div>
                            </div>

                            <input class="form-control d-none" name="nid_1" id="document-front-input"
                                onchange="documentFrontImageShow(event.target.files[0])" type="file">
                        </div>
                        <div class="form-group">
                            <label><span id="label-back"></span> Back Site</label>
                            <div id="preview-back"
                                class="w-full rounded-4 d-flex justify-content-center align-items-center"
                                style="height: 200px; border: 2px dotted #2980B9;" onclick="uploadDocumentBack()">

                                <div class=" text-center">
                                    {{-- <div class="text-white fs-3" style="width: 30px;">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div> --}}
                                    <h5 class="text-white">Upload the <b class=" text-info">back</b> of your
                                        document
                                    </h5>
                                </div>
                            </div>
                            <input class="form-control d-none" name="nid_2" type="file"
                                onchange="documentBackImageShow(event.target.files[0])" id="document-back-input">
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 d-flex justify-content-center"
                style="background-color: #1A1D23; color: white;  border-radius: 1px;">
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                <button type="submit" id="submit-btn" class="btn btn-info d-flex align-items-center">Upload</button>
            </div>
        </form>
    </div>
</div>

<script>
    let idCard = document.getElementById('id-card');
    let passport = document.getElementById('passport');
    let driverLicense = document.getElementById('driver-license');
    let documents = document.getElementById('documents');
    let documentTypeName = document.getElementById('document-type-name');
    let labelFront = document.getElementById('label-front');
    let labelBack = document.getElementById('label-back');
    let documentFrontInput = document.getElementById('document-front-input');
    let documentBackInput = document.getElementById('document-back-input');
    let previewDiv = document.getElementById('preview-front');
    let previewDivBack = document.getElementById('preview-back');
    let submitBtn = document.getElementById('submit-btn');
    let submitForm = document.getElementById('submit-form');
    let authUserDocumentType = @json(Auth::user()->document_type);
    let authUserDocumentFrontImage = @json(Auth::user()->nid_1);
    let authUserDocumentBackImage = @json(Auth::user()->nid_2);


    if (idCard.value === authUserDocumentType) {
        idCard.checked = true;
        onChangeDocumentTypes(idCard.value)
    } else {
        idCard.checked = false;
    }

    if (passport.value === authUserDocumentType) {
        passport.checked = true;
        onChangeDocumentTypes(passport.value)
    } else {
        passport.checked = false;
    }

    if (driverLicense.value === authUserDocumentType) {
        driverLicense.checked = true;
        onChangeDocumentTypes(driverLicense.value)
    } else {
        driverLicense.checked = false;
    }


    documentFrontInput.value = "";
    documentBackInput.value = "";

    function onChangeDocumentTypes(value) {
        documents.classList.remove("d-none");
        documentTypeName.innerText = value;
        labelFront.innerText = value;
        labelBack.innerText = value;
        let frontImg = document.createElement('img');
        let backImg = document.createElement('img');
        if (value === authUserDocumentType && authUserDocumentFrontImage) {
            previewDiv.innerHTML = ''; // Clear previous content
            frontImg.src = authUserDocumentFrontImage;
            frontImg.style.maxWidth = '100%'; // Adjust the image 
            frontImg.style.height = '100%'; // Adjust the image 
            previewDiv.appendChild(frontImg);
        } else {
            previewDiv.innerHTML = `<div class=" text-center" id="document-front-upload-text-centent">
                                    <span class="text-white fs-3"><i class="fas fa-cloud-upload-alt"></i></span>
                                    <h5 class="text-white">Upload the <b class=" text-info">front</b> of your
                                        document
                                    </h5>
                                </div>`;
        }
        if (value === authUserDocumentType && authUserDocumentBackImage) {
            previewDivBack.innerHTML = ''; // Clear previous content
            backImg.src = authUserDocumentBackImage;
            backImg.style.maxWidth = '100%'; // Adjust the image 
            backImg.style.height = '100%'; // Adjust the image 
            previewDivBack.appendChild(backImg);
        } else {
            previewDivBack.innerHTML = `<div class=" text-center">
                                    <span class="text-white fs-3"><i class="fas fa-cloud-upload-alt"></i></span>
                                    <h5 class="text-white">Upload the <b class=" text-info">back</b> of your
                                        document
                                    </h5>
                                </div>`;
        }
    }

    function uploadDocumentFront() {
        documentFrontInput.click();
    }

    function uploadDocumentBack() {
        documentBackInput.click();
    }

    function documentFrontImageShow(file) {
        previewDiv.innerHTML = ''; // Clear previous content

        let reader = new FileReader();

        reader.onload = function(e) {
            let img = document.createElement('img');
            img.src = e.target.result;
            img.style.maxWidth = '100%'; // Adjust the image 
            img.style.height = '100%'; // Adjust the image 
            previewDiv.appendChild(img);
        }
        reader.readAsDataURL(file);
    }

    function documentBackImageShow(file) {
        previewDivBack.innerHTML = ''; // Clear previous content

        let reader = new FileReader();

        reader.onload = function(e) {
            let img = document.createElement('img');
            img.src = e.target.result;
            img.style.maxWidth = '100%'; // Adjust the image 
            img.style.height = '100%'; // Adjust the image 
            previewDivBack.appendChild(img);
        }
        reader.readAsDataURL(file);
    }

    function onSubmitHandle(event) {
        if (documentFrontInput.value === "" && documentBackInput.value === "") {
            event.preventDefault();
        }
    }
</script>
{{-- <div class="modal-backdrop fade show z-n1"></div> --}}
