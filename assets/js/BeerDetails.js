import React from 'react';
import PropTypes from 'prop-types';
import {Button, Card} from "react-bootstrap";

export default function BeerDetails(props){
    const { beerDetails, onConsumeBeer, onRemoveBeer, onMoveBeer } = props;
    if (!beerDetails.data) {
        return (<p>Loading Data</p>)
    }
    return (<div className="beerdetails">
        <Card className="centeralign">
            <Card.Header as="h3">
                {beerDetails.data.name}
            </Card.Header>
            <Card.Body>
                <p>Name : {beerDetails.data.name}</p>
                <p>Brewer : {beerDetails.data.brewer}</p>
                <p>Style : {beerDetails.data.style}</p>
                <p>Location : {beerDetails.data.location}</p>
                <p>Bought on : {beerDetails.data.bought_on}</p>
            </Card.Body>
            <Button variant="secondary" onClick={() => onMoveBeer(beerDetails.data.id, 'fridge')}>
                Move
            </Button>
            <Button variant="primary" onClick={() => onConsumeBeer(beerDetails.data.id)}>
                Consume
            </Button>
            <Button variant="danger" onClick={() => onRemoveBeer(beerDetails.data.id)}>
                Remove
            </Button>
        </Card>
    </div>)
}

BeerDetails.propTypes = {
    beerDetails: PropTypes.object.isRequired,
    onConsumeBeer: PropTypes.func.isRequired,
    onRemoveBeer: PropTypes.func.isRequired,
    onMoveBeer: PropTypes.func.isRequired
};
