<!DOCTYPE html>
{% extends "layout.html" %}

{% block content %}
    
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Visitor Log</h1>
            <div>
		        <table class="table table-hover">
		            <thead>
		            <tr>
		            	<th scope="col">Visitor ID</th>
		                <th scope="col">First Name</th>
						<th scope="col">Last Name</th>
						<th scope="col">SSN</th>
						<th scope="col">Sex</th>
						<th scope="col">Relation</th>
						<th scope="col">Date of Visit</th>
						<th scope="col">Entry</th>
						<th scope="col">Exit</th>
		                <th scope="col">Prisoner</th>  
		        		<th scope="col">Details</th>
					</tr>
		            </thead>
		            <tbody>
		            {% for dat in data.visitorData %}
						<tr>
							<td scope='row'>{{ dat["vid"] }}</td>
							<td scope='row'>{{ dat["fname"] }}</td>
							<td scope='row'>{{ dat["lname"] }}</td>
							<td scope='row'>{{ dat["ssn"] }}</td>
							<td scope='row'>{{ dat["sex"] }}</td>
							<td scope='row'>{{ dat["relation"] }}</td>
							<td scope='row'>{{ dat["visit_on"] }}</td>
							<td scope='row'>{{ dat["in_time"] }}</td>
							<td scope='row'>{{ dat["out_time"] }}</td>
							<td scope='row'>{{ dat["pno"] }}</td>
							<td>
								<form action="{{url_for('prisoner_details')}}" method="GET">
									<input type="hidden" name="vnum" value="{{ dat['vid'] }}"/>
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