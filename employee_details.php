{% extends "layout2.html" %}

{% block content %}
<div class="container-fluid text-center top-container">
    <img src="{{ url_for('static',filename = 'images/noimage.jpg') }}">  <!-- /static/images/prison_icon.png -->
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Employee No. {{data.emp.ssn }}</h1>
            <form name="login" action="{{url_for('employees')}}" method="post">
                First Name : <input class="form-control" type = "text" name = "fname" value = "{{data.emp.fname }}" /><br />
                Last Name  : <input class="form-control" type = "text" name = "lname" value = "{{data.emp.lname }}" /><br />
                DOB        : <input class="form-control" type = "date" name = "dob" value = "{{data.emp.bdate}}" style="background-color: #f1f1f1;"/><br />
                Address    : <input class="form-control" type = "text" name = "address" value = "{{data.emp.address }}" /><br />
                Sex        : <select class="form-control" name = "sex" style="background-color: #f1f1f1;">
                                <option value = "M" {% if data.emp.sex == 'M' %} selected {% endif %}>Male</option>
                                <option value = "F" {% if data.emp.sex == 'F' %} selected {% endif %}>Female</option>
                                <option value = "O" {% if data.emp.sex == 'O' %} selected {% endif %}>Other</option>
                            </select><br />
                Designation :<input class="form-control" type = "text" name = "designation" value = "{{data.emp.designation}}" style="background-color: #f1f1f1;"/><br />
                Salary      :<input class="form-control" type = "number" name = "salary" value = "{{data.emp.salary}}" style="background-color: #f1f1f1;"/><br />
                Supervisor  :
                <select class="form-control" name = "super_ssn" style="background-color: #f1f1f1;">
                    <option value = "">--</option>
                {% for super in data.sup %}
                    <option value = "{{super.ssn}}" {% if data.emp.supervisor == super.ssn %} selected {% endif %}>{{super.fname}} {{super.lname}}</option>
                {% endfor %}
                </select>
                Block       : <input class="form-control" type = "text" name = "block"   value = "{{data.emp.block}}" style="background-color: #f1f1f1;"/><br />
                <input type = "hidden" name = "pno" value = "{{data.emp.ssn }}" />
                <input class="btn-submit" type="submit" name="submit" value="Submit">
            </form>
        </div>
	</div>
</div>
{% endblock  %}