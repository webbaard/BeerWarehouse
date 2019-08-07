import React from 'react';
import {ListGroup} from 'react-bootstrap';
import PropTypes from 'prop-types';

export default function Beers(props) {
    const {onSelection, beerList} = props;
    if (!beerList.data) {
        return (<p>Loading data</p>)
    }
    if (beerList.data.length <= 0) {
        return (<p>Nothing to show</p>)
    }
    return (
        <ListGroup>
            {beerList.data.map(beer =>
                <ListGroup.Item key={beer.id} onClick={() => onSelection(beer.id)}>
                    {beer.brewer} - {beer.name}
                </ListGroup.Item>
            )}
        </ListGroup>
    )
}

Beers.propTypes = {
    onSelection: PropTypes.func.isRequired,
    beerList: PropTypes.object.isRequired
};
