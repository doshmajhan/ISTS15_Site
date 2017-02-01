import flask
from flask import Flask
app = Flask(__name__)



@app.route('/addally', methods=['POST'])
def add_ally():
    """
        Handles request for adding an ally
        first form element should be the requesting country

        :returns status: The status of the request, 200 for OK, 500+ if error
    """



@app.route('/removeally', methods=['POST'])
def remove_ally():
    """
        Handles request for removing an ally
        first form element should be the requesting country

        :returns status: The status of the request, 200 for OK, 500+ if error
    """


@app.route('/check_ally', methods=['POST'])
def check_ally():
    """
        Checks if two countries are allies when a new code for a resource
        is added, to determine if the resource is shared or stolen.

        :return status: If the countries are allies or not, 1 if yes, 0 if no
    """



if __name__ == '__main__':
    app.run()
