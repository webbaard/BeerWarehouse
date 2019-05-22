import React, {Component} from 'react';
import Form from 'react-bootstrap/Form';
import Button from 'react-bootstrap/Button';
import PropTypes from "prop-types";

//This Component is a child Component of Customers Component
export default class AddBeerForm extends Component {

    constructor(props) {
        super(props);
        this.brewerInput = React.createRef();
        this.nameInput= React.createRef();
        this.shopInput= React.createRef();
        this.styleSelect = React.createRef();
        this.locationSelect = React.createRef();

        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleSubmit (event) {
        event.preventDefault();
        const { onNewBeerSubmit } = this.props;
        const nameInput = this.nameInput.current;
        const shopInput = this.shopInput.current;
        const brewerInput = this.brewerInput.current;
        const styleSelect = this.styleSelect.current;
        const locationSelect = this.locationSelect.current;

        onNewBeerSubmit(
            nameInput.value,
            shopInput.value,
            brewerInput.value,
            styleSelect.options[styleSelect.selectedIndex].value,
            locationSelect.options[locationSelect.selectedIndex].value
        );
    }

    render() {
        const { locationOptions, styleOptions } = this.props;
        if (!locationOptions.data) {
            return (<p>Loading data</p>)
        }
        if (locationOptions.data.length <= 0) {
            return (<p>Nothing to show</p>)
        }
        if (!styleOptions.data) {
            return (<p>Loading data</p>)
        }
        if (styleOptions.data.length <= 0) {
            return (<p>Nothing to show</p>)
        }
        return (<div className="addbeer">
            <Form onSubmit={this.handleSubmit}>
                <Form.Group controlId="brewer">
                    <Form.Label>Brewer's name</Form.Label>
                    <Form.Control type="text" ref={this.brewerInput} placeholder="Enter brewer"/>
                    <Form.Text className="text-muted">
                    </Form.Text>
                </Form.Group>
                <Form.Group controlId="name">
                    <Form.Label>Beer Name</Form.Label>
                    <Form.Control type="text" ref={this.nameInput} placeholder="Enter name"/>
                    <Form.Text className="text-muted">
                    </Form.Text>
                </Form.Group>
                <Form.Group controlId="shop">
                    <Form.Label>Beer Name</Form.Label>
                    <Form.Control type="text" ref={this.shopInput} placeholder="Enter shop"/>
                    <Form.Text className="text-muted">
                    </Form.Text>
                </Form.Group>
                <Form.Group controlId="style">
                    <Form.Label>Beer Style</Form.Label>
                    <Form.Control ref={this.styleSelect} as="select">
                        {styleOptions.data.map(option => {
                            return <option value={option.id} key={option.id}>{option.name}</option>
                        })}
                    </Form.Control>
                </Form.Group>
                <Form.Group controlId="location">
                    <Form.Label>Location</Form.Label>
                    <Form.Control ref={this.locationSelect} as="select">
                        {locationOptions.data.map(option => {
                            return <option value={option.id} key={option.id}>{option.room}-{option.container}-{option.shelf}</option>
                        })}
                    </Form.Control>
                </Form.Group>
                <Button type="submit">
                    Submit
                </Button>
            </Form>
        </div>)
    }
}

AddBeerForm.propTypes = {
    onNewBeerSubmit: PropTypes.func.isRequired,
    locationOptions: PropTypes.object.isRequired,
    styleOptions: PropTypes.object.isRequired
};
