
// khusus hal home
changeModified("after-img",function(){
	var img = ['engine/img/Alur_1.jpg','engine/img/Alur_2.jpg','engine/img/Alur_3.jpg'];
	
	count++;
	get = count % img.length;

	document.getElementById("heading").style.background = "url('"+img[get]+"') no-repeat top center";
	headMargin('heading','left','in');
});

changeModified("previous-img",function(){
	var img = ['engine/img/Alur_1.jpg','engine/img/Alur_2.jpg','engine/img/Alur_3.jpg'];
	
	count--;
	count = (count <= 0)? img.length:count;
	get = (count % img.length);

	document.getElementById("heading").style.background = "url('"+img[get]+"') no-repeat top center";
	headMargin('heading','right','in');
});


// close side menu
changeModified("close-side",function(){
	var sideMenu = document.getElementById('side-menu');
	var menu = document.getElementById('mn');
	var sideContent = document.getElementById('side-content');

	sideMenu.style.width = sideMenu.style.width == "5%"?"15%":"5%";

	sideContent.style.width = sideMenu.style.width == "5%"?"95%":"85%";

	menu.style.display = sideMenu.style.width == "5%" ? "none":"block";
	
});

// pencarian
changeModified("btn-cari",function(){
	var tambah = document.getElementById('bx-cari');

	if(tambah.style.display == ""){
		tambah.style.display = "block";
	}
	
});

changeModified("close-cari",function(){
	var pencarian = document.getElementById('bx-cari');

	if(pencarian.style.display == "block"){
		pencarian.style.display = ""
	}
	
});

// pengiriman
changeModified("btn-add-pengiriman",function(){
	var tambah = document.getElementById('bx-barang');

	if(tambah.style.display == ""){
		tambah.style.display = "block";
	}
	
});

changeModified("close-barang",function(){
	var tingkat = document.getElementById('bx-barang');

	if(tingkat.style.display == "block"){
		tingkat.style.display = ""
	}
	
});