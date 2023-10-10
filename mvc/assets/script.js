//ranger price slider
const rangeInput = document.querySelectorAll(".range-input input"),
priceInput = document.querySelectorAll(".price-input input"),
range = document.querySelector(".slider-product .progress");
let priceGap = 10000;

priceInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minPrice = parseInt(priceInput[0].value),
        maxPrice = parseInt(priceInput[1].value);
        document.querySelector(".from-price").textContent = minPrice.toLocaleString('vi-VN');
        document.querySelector(".to-price").textContent = maxPrice.toLocaleString('vi-VN');  
        if((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max){
            if(e.target.className === "input-min"){
                rangeInput[0].value = minPrice;
                range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
            }else{
                rangeInput[1].value = maxPrice;
                range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
            }
        }
    });
});

rangeInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minVal = parseInt(rangeInput[0].value),
        maxVal = parseInt(rangeInput[1].value);
        document.querySelector(".from-price").textContent = minVal.toLocaleString('vi-VN');
        document.querySelector(".to-price").textContent = maxVal.toLocaleString('vi-VN');  
        if((maxVal - minVal) < priceGap){
            if(e.target.className === "range-min"){
                rangeInput[0].value = maxVal - priceGap
            }else{
                rangeInput[1].value = minVal + priceGap;
            }
        }else{
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
            range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
        }
    });
});

//hiển thị hãng giày theo danh mục
function showBrand(selectedCategoryId) {
    // Gửi yêu cầu AJAX để lấy các hãng dựa trên danh mục được chọn
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Xử lý phản hồi từ máy chủ và cập nhật thẻ select "Hãng"
            var typesSelect = document.getElementById("typeSelect");
            typesSelect.innerHTML = "<option value=''>-- Chọn hãng --</option>"; // Đặt một option mặc định
            var types = JSON.parse(xhr.responseText); //  máy chủ trả về một danh sách các hãng dưới dạng JSON
            for (var i = 0; i < types.length; i++) {
                var option = document.createElement("option");
                option.value = types[i].id_type;
                option.text = types[i].name_type;
                typesSelect.appendChild(option);
            }
        }
    };

    xhr.open("GET", "brand.php?category_id=" + selectedCategoryId, true);
    xhr.send();
}


   
       
  