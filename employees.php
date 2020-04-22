{% extends "layout.html" %}

{% block content %}
    
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Employees</h1>
		    <div>
		        <table class="table table-hover">
		            <thead>
						<tr>
							<th scope="col">SSN</th>
							<th scope="col">Name</th>
							<th scope="col">DOB</th>
							<th scope="col">Sex</th>
							<th scope="col">Designation</th>
							<th scope="col">Supervisor</th>
							<th scope="col">Block</th>
							<th scope="col">Details</th>
						</tr>
		            </thead>
		            <tbody>
		            
		            {% for dat in data.employeeData %}
						<tr>
							<td scope="col">{{ dat['ssn'] }}</td>
							<td scope="col">{{ dat['fname']+" "+dat['lname'] }}</td>
							<td scope="col">{{ dat['bdate'] }}</td>
							<td scope="col">{{ dat['sex'] }}</td>
							<td scope="col">{{ dat['designation'] }}</td>
							<td scope="col">{{ dat['sfname']+" "+dat['slname'] }}</td>
							<td scope="col">{{ dat['block'] }}</td>
							<td>
								<form action="{{url_for('employee_details')}}" method="GET">
									<input type="hidden" name="enum" value="{{ dat['ssn'] }}"/>
								<button>Details</button>
								</form>
							</td>
						</tr>
		            {% endfor %}

		            </tbody>
		        </table>
		    </div>
        </div>
    </div>
</div>

{% endblock  %}