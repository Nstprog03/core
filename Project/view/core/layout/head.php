<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/style.css">
    <title><?php echo $this->getTitle(); ?></title>
    <script src="skin/admin/jquery-3.6.0.min.js"></script>
    <script src="skin/admin/admin.js"></script>
    <script type="text/javascript">

    function ppr() 
    {
        const pprValue = document.getElementById('ppr').selectedOptions[0].value;
        let language = window.location.href;
        if(!language.includes('ppr'))
        {
            language+='&ppr=20';
        }
        const myArray = language.split("&");
        for (i = 0; i < myArray.length; i++)
        {
            if(myArray[i].includes('p='))
            {
                myArray[i]='p=1';
            }
            if(myArray[i].includes('ppr='))
            {
                myArray[i]='ppr='+pprValue;
            }
        }
        const str = myArray.join("&");  
        location.replace(str);
    }

    </script>
    