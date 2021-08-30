function validate() {
    var name = document.addform.name.value;
    var address = document.addform.address.value;
    var status = false;

    var x = document.addform.email.value;
    var atposition = x.indexOf("@");
    var dotposition = x.lastIndexOf(".");

    var y = document.addform.phone.value;

    if (name.length < 1) {
        document.getElementById("namenotif").innerHTML = 
            " Tên không được để trống!";
        status = false;
    } 

    if (address.length < 1) {
        document.getElementById("addrnotif").innerHTML = 
            " Địa chỉ không được để trống";
        status = false;
    } 

    if (atposition < 1 || dotposition < (atposition + 2)
        || (dotposition + 2) >= x.length) {
        document.getElementById("emailnotif").innerHTML = 
            " Email không hợp lệ!";
        status = false;
    }

    

    if (y != '' &&  !/^[0-9]{10}$/.test(y)){
        document.getElementById("phonenotif").innerHTML = 
            " SĐT không hợp lệ!";
        status = false;
    }
    return status;
}