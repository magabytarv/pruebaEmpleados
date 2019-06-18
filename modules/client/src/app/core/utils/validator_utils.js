'use strict';

angular.module('Utils').factory('validator_utils', function(_){

  function validate_luhn(id_number) {
    var even = false;
    var sum = 0;
  
    _(id_number.split('').reverse()).each(function(digit) {
      digit = parseInt(digit, 10);
      if(even) {
        digit = digit * 2;
      }
  
      sum += _(digit.toString().split('')).reduce(function(total, digit) {
        digit = parseInt(digit, 10);
        return total + digit;
      }, 0);
      even = !even;
    });
  
    if((sum % 10 === 0) && (sum !== 0)){
      return true;
    }
  
    return false;
  }
  
  function is_id_card(r) {    
    if ((r != "") && (r != "9999999999")) {
            var str_ruc = r, //recuperamos el valor del campo
                pro = str_ruc.substring(0, 2),  //sacamos los 2 primero digitos para verificar la provincia
                pro1 = parseFloat(pro),
                cod = str_ruc.substring(2, 3),  //sacamos el tercer digito para verificar el tipo de institucion
                ver = str_ruc.substring(0, 9),  //sacamos los primeros 9 digitos que necesitamos para el calculo del digito verificador
                dig = str_ruc.substring(9, 10), //sacamos el decimo digito que es el de verificaci�
                dig1 = parseInt(dig),
                di = str_ruc.substring(8, 9), //sacamos el noveno digito que es el de verificaci� en unos casos
                dig2 = parseInt(di),

                a = ver.substring(0, 1),  //sacamos el primer d�ito
                b = ver.substring(1, 2),  //sacamos el segundo d�ito
                c = ver.substring(2, 3),  //sacamos el tercer d�ito
                d = ver.substring(3, 4),  //sacamos el cuarto d�ito
                e = ver.substring(4, 5),  //sacamos el quinto d�ito
                f = ver.substring(5, 6),  //sacamos el sexto d�ito
                g = ver.substring(6, 7),  //sacamos el septimo d�ito
                h = ver.substring(7, 8),  //sacamos el octavo d�ito
                i = ver.substring(8, 9),  //sacamos el noveno d�ito
            /*Tranformamos todos los digitos a enteros*/
                a1 = parseInt(a),
                b1 = parseInt(b),
                c1 = parseInt(c),
                d1 = parseInt(d),
                e1 = parseInt(e),
                f1 = parseInt(f),
                g1 = parseInt(g),
                h1 = parseInt(h),
                i1 = parseInt(i);

            if ((pro1 <= 0) || (pro1 >= 23)) {  //Validamos que los 2 primeros digitos sean entre 01 y 23 que corresponden a las provincias
                return  false;
            } else { //2
                if ((cod == "7") || (cod == "8")) {   //Verificamos que el tercer digito sea diferente de 7 u 8 ya que no puede tomar estos valores
                    return  false;
                } else {//3
                    if (cod == "9") {  //Si el tercer digito es 9 aplicamos el algoritmo de empresas privadas
                        var s = 0;
                        s = a1 * 4 + b1 * 3 + c1 * 2 + d1 * 7 + e1 * 6 + f1 * 5 + g1 * 4 + h1 * 3 + i1 * 2;
                        s = s % 11;
                        if (s != 0) {
                            s = 11 - s;
                        }
                        if (dig1 != s) {
                            return  false;
                        }
                    } else {//4
                        if (cod == "6") {  //Si el tercer digito es 6 aplicamos el algoritmo de empresas pblicas
                            s = 0;
                            s = a1 * 3 + b1 * 2 + c1 * 7 + d1 * 6 + e1 * 5 + f1 * 4 + g1 * 3 + h1 * 2;
                            s = s % 11;
                            if (s != 0) {
                                s = 11 - s;
                            }
                            if (dig2 != s) {
                                return false ;
                            }
                        } else { //5 // para los dem� digitos se usa el algoritmo de personas naturales
                            s = 0;
                            for (i = 0; i < 9; i++) {
                                var s2 = ver.substring(i, i + 1),
                                    s1 = parseInt(s2);
                                if ((i % 2) == 0) {
                                    s1 = s1 * 2;
                                    if (s1 >= 10) {
                                        var z = s1 / 10;
                                        z = parseInt(z);
                                        var y = s1 % 10;
                                        s1 = z + y;
                                    }
                                }
                                s = s + s1;
                            }
                            s = s - (parseInt((s / 10)) * 10);
                            if (s != 0) {
                                s = 10 - s;
                            }
                            if (dig1 != s) {
                                return false;
                            }
                        }//5
                    }//4
                }//3
            }//2
        }//1        
        return true;
  }
  
  function is_legal_ruc(value) {
    
    var first_ten_digits = value.substring(0, 10);
    if(!is_id_card(first_ten_digits)){
        return false
    }
    var third_digit = parseInt(value.substring(2, 3), 10);
    var last_three_numbers = value.substring(10, 13);
    
    var invalid_length = value.length !== 13;
    var invalid_third_digit = false; //(third_digit != 6 && third_digit != 9);
    var invalid_last_three_numbers = last_three_numbers != '001'
    
    if (invalid_length ||
        invalid_third_digit ||
        invalid_last_three_numbers) {
      return false;
    }
    return true;
  }
  
  return {
    is_id_card: function(value) {
      return is_id_card(value);
    },
    is_legal_ruc: function(value) {
      return is_legal_ruc(value);
    }
  };
});