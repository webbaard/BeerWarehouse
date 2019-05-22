import React from 'react';
import {ListGroup, Button} from 'react-bootstrap';
import PropTypes from 'prop-types';

export default function Locations(props) {
    const {onDelete, locationList} = props;
    if (!locationList.data) {
        return (<p>Loading data</p>)
    }
    if (locationList.data.length <= 0) {
        return (<p>Nothing to show</p>)
    }
    return (
        <ListGroup>
            {locationList.data.map(location =>
                <ListGroup.Item key={location.id}>
                    {location.room} - {location.container} - {location.shelf}
                    {" "}
                    <Button className="pull-right" size="sm" variant="danger" onClick={() => onDelete(location.id)}>
                        Delete
                    </Button>
                </ListGroup.Item>
            )}
        </ListGroup>
    )
}

Locations.propTypes = {
    onDelete: PropTypes.func.isRequired,
    locationList: PropTypes.object.isRequired
};
