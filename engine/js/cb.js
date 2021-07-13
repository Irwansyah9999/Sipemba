

// mengganti gambar dengan klik img bertipe array berisi path file
function change(id,img){
	var image = img;

	count = 0;
	var element = document.getElementById(id);
	if (document.getElementById(id) != null) {
		document.getElementById(id).onclick = function(){
		count++;
		var get = count % image.length;

		element.src = image[get];
		}
	} else {

	}
}

// mengubah elemente tertentu dengan klik element tersebut
function changeModified(id,obj){
	count = 0;
	var element = document.getElementById(id);

	if (document.getElementById(id) != null) {
		// proses klik
		
		document.getElementById(id).onclick = function(){
			obj();
		};
	} else {
		console.log('Tes');
	}
	
}

// mengubah elemente tertentu dengan klik element tersebut
function changeModifiedWithName(name,needle,obj){
	count = 0;

	var element = document.getElementsByName(name)[needle];

	if (document.getElementsByName(name)[needle] != null) {
		// proses klik
		
		document.getElementsByName(name)[needle].onclick = function(){
			obj();
		};
	} else {

	}
}

// mengubah elemente tertentu dengan klik element tersebut
function changeModifiedWithNameAll(name,obj){
	count = 0;

	var element = document.getElementsByName(name);
	for (var i = 0; i < element.length; i++) {
		if (document.getElementsByName(name)[i] != null) {
			// proses klik
			
			document.getElementsByName(name)[i].onclick = function(){
				obj();
			};
		} else {

		}	
	}
}


// mengubah elemente tertentu dengan klik element yang berbeda
function clicked(id,idTarget,objek){
	document.getElementById(id).onclick = function(){
		for(o in objek){
			document.getElementById(idTarget).style[o] = objek[o];
		}
	};
}

// cocok digunakan pada attribut element
function clickDisplay(id,display){
	if(document.getElementById(id) != null && document.getElementById(id+"In") != null){
		document.getElementById(id+"In").onclick = function(){
        var disp = document.getElementById(id);
	        if(disp.style['display'] == 'none'){
	            disp.style['display'] = display;
	        }else if(disp.style['display'] == display){
	            disp.style['display'] = 'none';
	        }else{
	        	disp.style['display'] = 'none';
	        }
		};
	}else{

	}
}

// cocok digunakan pada attribut element
function clickDisplayV2(id,target,display){
	if(document.getElementById(id) != null && document.getElementById(target) != null){
		
		document.getElementById(id).onclick = function(){
        var disp = document.getElementById(target);
        
        disp.style['display'] = (disp.style['display'] == '')? 'none':disp.style['display'];

	        if(disp.style['display'] == 'none'){
	            disp.style['display'] = display;
	        }else if(disp.style['display'] == display){
	            disp.style['display'] = 'none';
	        }
		};
	}else{

	}
}

// klik location
function onLocation(location){
	window.location = location;
}

// klik konfirm
function confirmation(message,location){
	var c = confirm(message);
	
	if(c == true){
		window.location = location;
	}
}

// print
function printPage(){
	window.print();
}

function printElement(el) {
	var pageBody = document.body.innerHTML;
	var pagePrint = document.getElementById(el).innerHTML;

	document.body.innerHTML = pagePrint;
	
	window.print();

	document.body.innerHTML = pageBody;
}

// add elemen
function Element(parent,child) {
	var element = document.createElement(parent);
	var child = document.createElement(child);

	function setChild(params) {
		
	}

	function setElement(element){
		
	}
	
	function getElement(){
		return element;
	}
}

function element(){
	var input = document.createElement('input');

	input.setAttribute('type','text');
	input.setAttribute('name','kode');
	input.setAttribute('class','form-control');
	input.setAttribute('placeholder','Kode');

	var td = document.createElement('td');

	var tr = document.createElement('tr');

	var elemen = document.getElementById('table-cp');

	td.appendChild(input);

	tr.appendChild(td);

	elemen.appendChild(tr);

}

// cek validasi
function validation(datas){

	for (data in datas) {

		var input = document.getElementsByName(data)[0];

		if(input == undefined){
			window.location = '?action=add&#add';
		}else{
			if(input.value == ''){
				input.style['border-color'] = "red";
				alert("input "+data+" kosong");
				window.location = '?action=add&#add';
			}else{
				
			}
		}
	}
}


// penambahan css berdasarkan atribut id
// obj = property css dengan penulisan { nameProperty:"value" }
function addCssWithId(id,objek){
	var element = document.getElementById(id);
	if(typeof objek == 'string'){
		var css = (element.getAttribute('style') == null)?"":element.getAttribute('style')+" ";
		element.setAttribute('style',css+objek);
	}else if(typeof objek == 'object'){
		if(document.getElementById(id) != null){
			for(o in objek){
				document.getElementById(id).style[o] = objek[o];
			}
		}else{
			console.log("id not found");
		}	
	}
}

// penambahan css berdasarkan atribut name
// obj = property css dengan penulisan { nameProperty:"value" }
// needle = urutan atribut name pada file dokumen 
function addCssWithName(name,objek,needle){
	if(document.getElementsByName(name) != null){		
		for(o in objek){
			document.getElementsByName(name)[needle].style[o] = objek[o];
		}
	}else{
		console.log("name not found");
	}
}

// penambahan css berdasarkan atribut class
// obj = property css dengan penulisan { nameProperty:"value" }
// needle = urutan atribut class pada file dokumen 
function addCssWithClass(className,objek,needle){
	if (document.getElementsByClassName(className) != null) {
		
		for(o in objek){
			document.getElementsByClassName(className)[needle].style[o] = objek[o];
		}
	} else {
		console.log("class not found");
	}
}

// geser image ke kanan atau ke kiri
function head(id,geser,fade){
	var element = document.getElementById(id);
	var add;

	if(element != null){
		element.style[geser] = '0';
		if(fade == 'in'){
			add = 1;
			element.style.width = '1%';
		}else{
			add = 95;
			element.style.width = '100%';
		}


		var interval = setInterval(() => {
			if(add == 100 || add == 0){
				(fade == 'in')? element.style.width = '100%' : element.style.width = '0';
				clearTimeout(interval);
			}
				element.style.width = add+'%';
				
				(fade == 'in')? add++ : add--;
		},0.2);
	}
}

// geser image ke kanan atau ke kiri
function headMargin(id,geser,fade){
	var element = document.getElementById(id);
	var add;

	if(element != null){
		element.style.float = geser;
		if(fade == 'in'){
			add = 1;
			element.style.width = '1%';
		}else{
			add = 99;
			element.style.width = '100%';
		}

		var interval = setInterval(() => {
			if(add == 100 || add == 0){
				(fade == 'in')? element.style.width = '100%' : element.style.width = '0';
				clearTimeout(interval);
			}
				element.style.width = add+'%';
				
				(fade == 'in')? add++ : add--;
		},0.5);
	}
}

function autoRefresh(t){
	setTimeout(()=>{
		location.reload(true)
	},t);
}

function WordText(){
	this.name = name;
	this.group = array('Text','Aligment');

	function setName(name){
		this.name = name;
	}

	function setGroup(group){
		this.group = group;
	}

}

function modal(needle,action){
	var modal = document.getElementsByClassName("modal")[needle];

	var t = document.getElementsByClassName("modal-true");

	var f = document.getElementsByClassName("modal-false");

	t.onclick = function(){
		action();
	}

	f.onclick = function(){
		modal.style.display = "none";
	}
}