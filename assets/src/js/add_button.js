	function alterAmounth(value){
		let inputMain = Number(document.getElementById('input-product').value)
	    console.log(inputMain, value)
	    document.getElementById('input-product').value = inputMain + value
	    if (document.getElementById('input-product').value <=1 ) {
	    document.getElementById('input-product').value = 1
	    }else{
	    document.getElementById('input-product').value = inputMain + value
		}
	}	
