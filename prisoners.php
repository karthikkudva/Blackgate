{% extends "layout.html" %}

{% block content %}
    
    <div class="row">
        <div class="col-md-12 text-center">
			<h1>Prisoners</h1>
			<form class="form-inline">
				
			</form>
		    <div>
		        <table class="table table-hover">
		            <thead>
		            <tr>
		            	<th scope="col">Prisoner No.</th>
		                <th scope="col">First Name</th>
		                <th scope="col">Last Name</th>
		                <th scope="col">Date Of Birth</th>
		                <th scope="col">Sex</th>
						<th scope="col">Cell No.</th>
						<th scope="col">Block</th>
		                <th scope="col">Details</th>  
					</tr>
		            </thead>
		            <tbody>
		            
		            {% for dat in data.prisonerData %}
		            <tr>
		                <td scope='row'>{{ dat["pno"] }}</td>
		                <td>{{ dat["fname"] }}</td>
		                <td>{{ dat["lname"] }}</td>
		                <td>{{ dat["dob"] }}</td>
		                <td>{{ dat["sex"] }}</td>
						<td>{{ dat["cell"] }}</td>
						<td>{{ dat["block"] }}</td>
		                <td>
		                	<form action="{{url_for('prisoner_details')}}" method="GET">
		                		<input type="hidden" name="pnum" value="{{ dat['pno'] }}"/>
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