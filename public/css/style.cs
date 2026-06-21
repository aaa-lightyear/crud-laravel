*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}
.form{
    display: flex;
    flex-direction: column;
    gap: 20px;
    justify-content: center;
    align-items: center;
}
.input_name, .input_email {
    width: 300px;
    border-radius: 5px;
    border: 1px solid lightblue;;
    padding: 10px;
}
input:focus{
    outline: none;
    border: 2px solid blue;
    
}
.form select{
    width: 150px;
}
.login{
    width: 100px;
    padding: 5px;
    background-color: lightblue;
    cursor: pointer;
    transition: 0.3s;
    border-radius: 5px;
    border: none;
}
.login:hover{
    background-color: blue;
}
