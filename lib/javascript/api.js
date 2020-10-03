
function callPhpFunction(functionName, params, callback){
    
	jQuery.ajax({
        type: "POST",
        url: './lib/php/call_function.php',
        dataType: 'json',
        data: {functionname: functionName, arguments: params},
    
        success: callback,
    });
}