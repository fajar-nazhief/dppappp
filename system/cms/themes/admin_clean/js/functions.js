
var base_url=window.location.origin + '/' + window.location.pathname.split ('/') [1] + '/';
(function(window){
	window.htmlentities = {
		/**
		 * Converts a string to its html characters completely.
		 *
		 * @param {String} str String with unescaped HTML characters
		 **/
		encode : function(str) {
			var buf = [];
			
			for (var i=str.length-1;i>=0;i--) {
				buf.unshift(['&#', str[i].charCodeAt(), ';'].join(''));
			}
			
			return buf.join('');
		},
		/**
		 * Converts an html characterSet into its original character.
		 *
		 * @param {String} str htmlSet entities
		 **/
		decode : function(str) {
			return str.replace(/&#(\d+);/g, function(match, dec) {
				return String.fromCharCode(dec);
			});
		}
	};
})(window);

function empty(str){
    return !str || !/[^\s]+/.test(str);
}


function validateUsername(fld) {
    var error = "";
    var illegalChars = /\W/; // allow letters, numbers, and underscores
 
    if (fld == "") {
        
        error = "You didn't enter a username.\n";
        onMessage(error);
        return false;
 
    } else if ((fld < 5) || (fld > 15)) {
      
        error = "The username is the wrong length.\n";
		onMessage(error);
		return false;
 
    } else if (illegalChars.test(fld)) {
        
        error = "Username tidak boleh mengandung spasi .\n";
		onMessage(error);
		return false;
 
    }  
    return true;
}

function validatePassword(fld) {
    var error = "";
    var illegalChars = /[\W_]/; // allow only letters and numbers
 
    if (fld == "") { 
        error = "Password tidak boleh kosong.\n";
        onMessage(error);
        return false;
 
    } else if ((fld.length < 6) || (fld.length > 15)) {
        error = "Panjang password minimum 7 karakter. \n";
        onMessage(error);
        return false;
 
    } else if (illegalChars.test(fld)) {
        error = "Password harus terdiri dari gabungan karakter dan numerik contoh: fulanbinfulan21 .\n";
        onMessage(error);
        return false;
 
    } else if ( (fld.search(/[a-zA-Z]+/)==-1) || (fld.search(/[0-9]+/)==-1) ) {
        error = "Password harus terdiri dari gabungan karakter dan numerik contoh: fulanbinfulan21 .\n";
        onMessage(error);
        return false;
 
    } 
   return true;
}

function onMessage(error){
	myApp.alert(error,'PERHATIAN!');
}

function getOptions(id,url){

    $('#'+id).children().remove();
    $('#'+id).append('<option value="" selected="selected">Please select...</option>');
                                    
    
    $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(e) {
                    
                    for( var i = 0; i < e.result.length; i++ ){
                                    
                        $('#'+id).append('<option value="'+e.result[i].value+'" >'+e.result[i].label+'</option>');
                    }
                    $('#'+id).trigger("chosen:updated");
            }
    });
}

function getOptionsEdit(id,url,value){

$('#'+id).children().remove();
$('#'+id).append('<option value="" selected="selected">Please select...</option>');

$.ajax({
        type: "GET",
        url: url,
        dataType: "json",
        success: function(e) {
                
                for( var i = 0; i < e.result.length; i++ ){
                                
                    $('#'+id).append('<option value="'+e.result[i].value+'" >'+e.result[i].label+'</option>');
                }
                
                $('#'+id).val(value);
                $('#'+id).trigger("chosen:updated");
        }
});
}



function getKota(a,inputx){
    getOptions(inputx,"admin/pemain/kota/"+a);
}

function getKecamatan(a,inputx){
    getOptions(inputx,"admin/pemain/kecamatan/"+a);
}

function getKelurahan(a,inputx){
    getOptions(inputx,"admin/pemain/kelurahan/"+a);
}

function getFormData(data) {
    var unindexed_array = data;
    var indexed_array = {};

    $.map(unindexed_array, function (n, i) {
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}

 

function formJson(namaform) {
    var data = $("#" + namaform).serializeArray();
    return JSON.stringify(getFormData(data))
}

function tgls(a){
    var dateAr = a.split('-');
    //alert(JSON.stringify(dateAr))
return  dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0];
}




function api(url,method,form, callback){ 
    var dataarr='';
    if(method==='post'){
        var frmdata = formJson(form);
    }  
     
    $.ajax({
        url: url,
        type: method,
        dataType: 'json',
        contentType: 'application/json',
        success: function (data) {
           callback(data); 
        },
        error: function( jqXhr, textStatus, errorThrown ){
            swal('Upps!,maaf terjadi kesalahan pada server!'); 
        },
        data: frmdata
    });
               


    } 

    function api3(url,method,form, callback){ 
        var dataarr='';
        if(method==='post'){
            var frmdata = frm2json(form);
           // frmdata.append( 'files', $('#camerafoto')[0].files[0]);
        } 
        myApp.showIndicator();
         
        $.ajax({
            url: url,
            headers: {
                'Authorization': localStorage.getItem("Token"),
                'X_CSRF_TOKEN':'donimaulana' 
            },
            type: 'post',
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,
            success: function (data) {
               callback(data);
                myApp.hideIndicator(); 
            },
            error: function( jqXhr, textStatus, errorThrown ){
                alert('Upps!');
                myApp.hideIndicator();
            },
            data: frmdata
        });
                   
    
    
        }


    function nomor(x) {
        var parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
    }

    function bukapop(title,content){
        myApp.alert(content,title);
      }

      function notif(a,b){
        myApp.addNotification({
            title: b,
            message: a
        });
      }

      function autonamabarang(id){
        myApp.autocomplete({
            input: '#'+id,
            openIn: 'dropdown',
            preloader: true, //enable preloader
            valueProperty: 'id', //object's "value" property name
            textProperty: 'name', //object's "text" property name
            limit: 20, //limit to 20 results
            dropdownPlaceholderText: 'Masukkan nama barang',
            expandInput: true, // expand input
            source: function (autocomplete, query, render) {
                var results = [];
                if (query.length === 0) {
                    render(results);
                    return;
                }
                // Show Preloader
                autocomplete.showPreloader();
                // Do Ajax request to Autocomplete data
                $.ajax({
                    url: base_url+'mobile/mobile/barang/?Authorization='+localStorage.Token,
                    method: 'GET',
                    dataType: 'json',
                    //send "query" to server. Useful in case you generate response dynamically
                    data: {
                        query: query
                    },
                    success: function (data) {
                        // Find matched items
                        for (var i = 0; i < data.length; i++) {
                            if (data[i].name.toLowerCase().indexOf(query.toLowerCase()) >= 0) results.push(data[i].name);
                        }
                        // Hide Preoloader
                        autocomplete.hidePreloader();
                        // Render items by passing array with result items
                        render(results);
                    }
                });
            }
          });
      }

      function addElement(parentId, elementTag, elementId, html) {
        // Adds an element to the document
        var p = document.getElementById(parentId);
        var newElement = document.createElement(elementTag);
        newElement.setAttribute('id', elementId);
        newElement.innerHTML = html;
        p.appendChild(newElement);
    }

    function removeElement(elementId) {
        // Removes an element from the document
        var element = document.getElementById(elementId);
        element.parentNode.removeChild(element);
    }

    function removerow(id){
       // $("#" + id).remove();
       // document.getElementById(id).deleteRow(row);
       $(this).parents('tr').remove(); 
    }

    function deleteRow(row) {
        //alert(row);
        // var d = row.parentNode.parentNode.rowIndex;
        document.getElementById('dsTable').deleteRow(row);
        sumcol('4');
        sumcol1('1');
    }

    function delallrow(){
        var myTable = document.getElementById("raciktbl");
        var rowCount = myTable.rows.length;
        for (var x=rowCount-2; x>0; x--) {
        myTable.deleteRow(x);
        }
    }

    
    
    function tableclick(e) {
        if(!e)
         e = window.event; 
        if(e.target.value == "Delete"){
            deleteRow( e.target.parentNode.parentNode.rowIndex );
        }else if(e.target.value == "Hapus"){
            deleteRowRacik( e.target.parentNode.parentNode.rowIndex );
        }else if(e.target.value == "Batal"){
            deleteRowkasirprod( e.target.parentNode.parentNode.rowIndex );
        }
        
           
    }

    function isNumber(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    function sumcol(col){
        sum = 0;
        $("#dsTable > tbody  > tr").each(function(rowindex) {
         $(this).find("td:nth-child(" + col + ")").each(function(rowindex) {
            newval = $(this).find('#subtot').val();
            //alert(newval);
            if (isNaN(newval)) {
              $('#totalkb').html(nomor(sum));
              hitungkembalikb();
            } else {
              sum += parseInt(newval);
              //sumcol1('1');
            }
          });
         // $('.total').html(sum);
        });
    }

    function sumcol1(col){
        sum = '';
        $("#dsTable > tbody  > tr").each(function(rowindex) {
         $(this).find("td:nth-child(" + col + ")").each(function(rowindex) {
            newval = $(this).find('#subidkb').val();
            //alert(newval);
            if (isNaN(newval)) {
              $('#subidkbval').val((sum)); 
            } else {
              sum += ','+newval;
            }
          });
         // $('.total').html(sum);
        });
    }

    

    function initswiper(){
        var mySwiper = new Swiper ('.swiper-container', {
            // Optional parameters
            pagination: '.swiper-pagination',
            paginationClickable: true,
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            lazyLoading: true,
            spaceBetween: 0,
            parallax: true,
            autoplay: 5000,
            speed: 800,
            autoplayDisableOnInteraction: false
          }) 
    }

    function setOptions(srcType) {
        var options = {
            // Some common settings are 20, 50, and 100
            quality: 50,
            destinationType: Camera.DestinationType.FILE_URI,
            // In this app, dynamically set the picture source, Camera or photo gallery
            sourceType: srcType,
            encodingType: Camera.EncodingType.JPEG,
            mediaType: Camera.MediaType.PICTURE,
            allowEdit: false,
            correctOrientation: true  //Corrects Android orientation quirks
        }
        return options;
    }
    

    function bukakamera(selection) {
if(selection ==='camera'){
    var srcType = Camera.PictureSourceType.CAMERA;
}else{
    var srcType = Camera.PictureSourceType.SAVEDPHOTOALBUM;
}
        
   
    var options = setOptions(srcType);
    var func = createNewFileEntry;

    navigator.camera.getPicture(function cameraSuccess(imageUri) {

        displayImage(imageUri);
        // You may choose to copy the picture, save it somewhere, or upload.
        //func(imageUri);

    }, function cameraError(error) {
        console.debug("Unable to obtain picture: " + error, "app");

    }, options);
    }

    function displayImage(imgUri) {

        var elem = document.getElementById('imgfile');
        elem.src = imgUri;
    }
    function createNewFileEntry(imgUri) {
        window.resolveLocalFileSystemURL(cordova.file.cacheDirectory, function success(dirEntry) {
    
            // JPEG file
            dirEntry.getFile("tempFile.jpeg", { create: true, exclusive: false }, function (fileEntry) {
    
                // Do something with it, like write to it, upload it, etc.
                // writeFile(fileEntry, imgUri);
                alert("got file: " + fileEntry.fullPath);
                // displayFileData(fileEntry.fullPath, "File copied to");
    
            }, onErrorCreateFile);
    
        }, onErrorResolveUrl);
    }
        
    
    
    
    
     

function notif(pesan){
    myApp.addNotification({
        title: 'Perhatian!',
        message: pesan
    });
}
        

function regis_act(url,method,form){
    var dataarr='';
    if(method==='post'){
        var frmdata = frm2json(form);
    } 

    myApp.showIndicator();
     
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        contentType: 'application/json',
        success: function (data) {
           regis_result(data);
            myApp.hideIndicator(); 
        },
        data: frmdata
    });
         
}
function regis(){
   
           if(empty($('#ktp').val())){
               notif('Nomor KTP wajib diisi!');
                $('#ktp').focus(); 
                return false;
            }else if(empty($('#nama').val())){
                notif('Nama Lengkap wajib diisi!');
                 $('#nama').focus(); 
                 return false;
             }else if(empty($('#alamat').val())){
                notif('Alamat wajib diisi!');
                 $('#alamat').focus(); 
                 return false;
             }else if(empty($('#kelamin').val())){
                notif('Jenis Kelamin wajib diisi!');
                 $('#kelamin').focus(); 
                 return false;
             }else if(empty($('#agama').val())){
                notif('Agama wajib diisi!');
                 $('#agama').focus(); 
                 return false;
             }else if(empty($('#pendidikan').val())){
                notif('Pendidikan wajib diisi!');
                 $('#pendidikan').focus(); 
                 return false;
             }else if(empty($('#alamat').val())){
                notif('Alamat Lengkap wajib diisi!');
                 $('#alamat').focus(); 
                 return false;
             }else if(empty($('#provinsi').val())){
                notif('Provinsi wajib diisi!'); 
                 return false;
             }else if(empty($('#kabupaten').val())){
                notif('Kabupaten wajib diisi!'); 
                 return false;
             }else if(empty($('#kecamatan').val())){
                notif('Kecamatan wajib diisi!'); 
                 return false;
             }else if(empty($('#kelurahan').val())){
                notif('Kelurahan wajib diisi!'); 
                 return false;
             }else if(empty($('#hp').val())){
                notif('Nomor HP wajib diisi!'); 
                 return false;
             }else if(empty($('#email').val())){
                notif('Email wajib diisi!'); 
                 return false;
             }else if(empty($('#username').val())){
                notif('Username wajib diisi!'); 
                 return false;
             }else if(empty($('#pass1').val())){
                notif('Password wajib diisi!'); 
                 return false;
             }else if(empty($('#pass2').val())){
                notif('Re-Password wajib diisi!'); 
                 return false;
             }else if($('#pass1').val() !== $('#pass2').val() ){
                notif('Password tidak sama!'); 
                 return false;
             }else{
                 api(base_url+'/api/appdata/regis','post','form-upload',regis_result);
                  
             }

             return false;
            
          }

          function regis_result(a){ 
              if(a.result=='ok'){
                notif('Selamat pendaftaran anda telah berhasil!');
                document.getElementById('form-upload').reset(); 
              }else{
                onMessage('Username yang anda masukkan sudah ada yang menggunakan!');
              }
                
           
          }


          function login(){
            api(base_url+'/api/appdata/login2','post','form-login',login_result);
            return false;
          }

          function login_result(a){
            if(a.result=='gagal'){
                onMessage(a.msg);
            }else{
                    localStorage.setItem("Token", a.token);
                    localStorage.setItem("id", a.id);
                    localStorage.setItem("group", a.group);
            }
          }


          function camera_confirm(){
            navigator.camera.getPicture(suksescamconfirm, onFailed, { quality: 20,
                destinationType: Camera.DestinationType.FILE_URL 
            });
          }

          function suksescamconfirm(imageData){ 
            var src = imageData + '?' + Math.random();
            $('#imgcam').html('<img src="'+src+'">'); 
          $('#imgcam').val(src);
          // {data: imageData}
          $.ajax({
            url: base_url+'/api/master/konfirmasi',
            headers: {
                'Authorization': localStorage.getItem("Token"),
                'X_CSRF_TOKEN':'donimaulana' 
            },
            type: 'post',
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,
            success: function (data) {
              alert();
                myApp.hideIndicator(); 
            },
            error: function( jqXhr, textStatus, errorThrown ){
                alert('Upps!');
                myApp.hideIndicator();
            },
            data: {data: imageData}
        });
          }

          function onFailed(message) {
            alert('Failed because: ' + message);
        }


        function konfirmasi(){
            if(empty($('#camerafoto').val())){
                myApp.alert('Photo belum dipilih!','Perhatian!');
                
            }else{
                if(empty(localStorage.getItem("Token"))){
                    myApp.alert('Anda harus login terlebih dahulu untuk melanjutkan proses konfirmasi!');
                }else{
                    api3(base_url+'/api/master/konfirmasi','post','form-konfirmasi',konfirmasi_result);
                }
            }
            return false;
        }

        function konfirmasi_result(data){
alert();
        }



        function uploadFromGallery() {

            // Retrieve image file location from specified source
            navigator.camera.getPicture(uploadPhoto,
                                        function(message) { alert('get picture failed'); },
                                        { quality: 50, 
                                        destinationType: navigator.camera.DestinationType.FILE_URI,
                                        sourceType: navigator.camera.PictureSourceType.PHOTOLIBRARY }
                                        );
        
        }

        function uploadPhoto(imageURI) {
            var options = new FileUploadOptions();   
            options.chunkedMode = false;
               
            options.fileKey="file";
            options.fileName=imageURI.substr(imageURI.lastIndexOf('/')+1)+'.png';
            options.mimeType="text/plain";
        
           

            var params = {};
params.headers = { 'Authorization': localStorage.getItem('Token')};
//params.value1 = "someparams";
//params.value2 = "otherparams";

options.params = params;
        
            var ft = new FileTransfer();
            ft.upload(imageURI, encodeURI("http://jakarta-tourism.go.id/enjoy/api/master/konfirmasi"), win, fail, options);
        }
        
        function win(r) {

            alert("token"+localStorage.getItem('Token')+"Code = " + r.responseCode+"Response = " + r.response+"Sent = " + r.bytesSent);
            
        }
        
        function fail(error) {
            alert("An error has occurred: Code = " + error.code+"upload error source " + error.source+"upload error target " + error.target);
            
        }