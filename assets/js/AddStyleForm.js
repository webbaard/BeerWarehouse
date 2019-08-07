import React, {Component} from 'react';
import Form from 'react-bootstrap/Form';
import Button from 'react-bootstrap/Button';
import PropTypes from "prop-types";

//This Component is a child Component of Customers Component
export default class AddStyleForm extends Component {

    constructor(props) {
        super(props);
        this.nameInput = React.createRef();

        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleSubmit (event) {
        event.preventDefault();
        const { onNewStyleSubmit } = this.props;
        const nameInput = this.nameInput.current;

        onNewStyleSubmit(
            nameInput.value
        );
    }

    render() {
        return (<div className="addstyle">
            <Form onSubmit={this.handleSubmit}>
                <Form.Group controlId="style">
                    <Form.Label>Style Name</Form.Label>
                    <Form.Control type="text" ref={this.nameInput} placeholder="Enter style name"/>
                    <Form.Text className="text-muted">
                    </Form.Text>
                </Form.Group>
                <Button type="submit">
                    Submit
                </Button>
            </Form>
        </div>)
    }
}

AddStyleForm.propTypes = {
    onNewStyleSubmit: PropTypes.func.isRequired
};
