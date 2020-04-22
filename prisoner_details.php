{% extends "layout2.html" %}

{% block content %}
<div class="container-fluid text-center top-container">
    <img src="{{ url_for('static',filename = 'images/noimage.jpg') }}">  <!-- /static/images/prison_icon.png -->
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Prisoner No. {{data.pi.pno }}</h1>
            <form name="login" action="" method="post">
                First Name : <input class="form-control" type = "text" name = "fname" value = "{{data.pi.fname }}" /><br />
                Last Name  : <input class="form-control" type = "text" name = "lname" value = "{{data.pi.lname }}" /><br />
                Ssn        : <input class="form-control" type = "text" name = "ssn" value = "{{data.pi.ssn }}" /><br />
                DOB        : <input class="form-control" type = "date" name = "dob" value = "{{data.pi.dob }}" style="background-color: #f1f1f1;"/><br />
                Sex        : <select class="form-control" name = "sex" style="background-color: #f1f1f1;">
                                <option value = "M" {% if data.pi.sex == 'M' %} selected {% endif %}>Male</option>
                                <option value = "F" {% if data.pi.sex == 'F' %} selected {% endif %}>Female</option>
                                <option value = "O" {% if data.pi.sex == 'O' %} selected {% endif %}>Other</option>
                             </select><br />
                Start      : <input class="form-control" type = "date" name = "start" value = "{{data.pi.start }}" style="background-color: #f1f1f1;"/><br />
                End        : <input class="form-control" type = "date" name = "end"   value = "{{data.pi.end }}" style="background-color: #f1f1f1;"/><br />
                Cell       : <input class="form-control" type = "text" name = "cell"   value = "{{data.pi.cell }}" style="background-color: #f1f1f1;"/><br />
                Charges    :
                <div id = "chargeDiv">
                {% for offense in data.offenses %}
                    <div class="input-group mb-3"> 
                        <div class="input-group-prepend">
                            <span class="input-group-text">Charge</span>
                        </div>
                        <select class="form-control" name = "offenses" style="background-color: #f1f1f1;">
                            <option value = "None">None</option>
                        {% for charge in  data.charges  %}
                            <option value = "{{charge[0]}}" {% if charge[1] ==  offense[1] %} selected {% endif %}>{{charge[1]}}</option>
                        {% endfor %}
                        </select>
                        <input class="form-control" type = "number" name = "count" value = "{{offense[2]}}" style="background-color: #f1f1f1;"/>
                        <button class="btn btn-secondary"> - </button>
                    </div>
                {% endfor %}
                </div>
                <div class="col">
                    <button id = "AddBtn" class="btn add" onclick="myFunction()"> + </button>
                </div>
                <input type = "hidden" name = "pno" value = "{{data.pi.pno }}" />
                <input class="btn-submit" type="submit" name="submit" value="Submit">
            </form>
        </div>
	</div>
</div>
<script>
    $(document).ready(function(){
      $("AddBtn").click(function(){
        var a = ` <div class="input-group mb-3"> 
                    <div class="input-group-prepend">
                        <span class="input-group-text">Charge</span>
                    </div>
                    <select class="form-control" name = "offenses" style="background-color: #f1f1f1;">
                        <option value = "None">None</option>
                    {% for charge in  data.charges  %}
                        <option value = "{{charge[0]}}"selected>{{charge[1]}}</option>
                    {% endfor %}
                    </select>
                    <input class="form-control" type = "number" name = "count" style="background-color: #f1f1f1;"/>
                    <button class="btn btn-secondary"> - </button>
                </div> `;
        var b = "<button> new </button>"
        $("#chargeDiv").append(b);
      });
    });
    </script>

{% endblock  %}