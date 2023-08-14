<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Resume</title>
</head>
<body>
    <div style="margin: 0 auto;display: block;width: 500px;">
        <table width="100%" border="1">
            <tr>
                <td>Appointment Date:</td>
                <td>{{$appointment_data}}</td>
            </tr>
            <tr>
                <td>Request Date:</td>
                <td>{{$request_date}}</td>
            </tr>
            <tr>
                <td> Customer Name:</td>
                <td>{{$customer_name}}</td>
            </tr>
            <tr>
                <td>Salesperson Name:</td>
                <td>{{$salesperson_name}}</td>
            </tr>
            <tr>
                <td colspan="2">
                    <img src="{{$signature}}" style="width:200px;"> 
                </td>
            </tr>
        </table>
    </div>
</body>
</html>