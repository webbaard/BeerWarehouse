import React, {Component} from 'react';
import Form from 'react-bootstrap/Form';
import Button from 'react-bootstrap/Button';
import PropTypes from "prop-types";

//This Component is a child Component of Customers Component
export default class AddLocationForm extends Component {

    constructor(props) {
        super(props);
        this.nameInput = React.createRef();
        this.containerInput= React.createRef();
        this.shelfInput= React.createRef();

        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleSubmit (event) {
        event.preventDefault();
        const { onNewLocationSubmit } = this.props;
        const containerInput = this.containerInput.current;
        const shelfInput = this.shelfInput.current;
        const roomInout = this.nameInput.current;

        onNewLocationSubmit(
            containerInput.value,
            shelfInput.value,
            roomInout.value
        );
    }

    render() {
        return (<div className="addlocation">
            <Form onSubmit={this.handleSubmit}>
                <Form.Group controlId="room">
                    <Form.Label>Room name</Form.Label>
                    <Form.Control type="text" ref={this.nameInput} placeholder="Enter room"/>
                    <Form.Text className="text-muted">
                    </Form.Text>
                </Form.Group>
                <Form.Group controlId="container">
                    <Form.Label>Container Name</Form.Label>
                    <Form.Control type="text" ref={this.containerInput} placeholder="Enter container"/>
                    <Form.Text className="text-muted">
                    </Form.Text>
                </Form.Group>
                <Form.Group controlId="shelf">
                    <Form.Label>Shelf Name</Form.Label>
                    <Form.Control type="text" ref={this.shelfInput} placeholder="Enter shelf"/>
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

AddLocationForm.propTypes = {
    onNewLocationSubmit: PropTypes.func.isRequired
};
