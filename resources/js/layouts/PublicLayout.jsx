import React from 'react';
import { Box } from '@chakra-ui/react';
import { Outlet } from 'react-router-dom';

const PublicLayout = () => {
    return (
        <Box>
            <Outlet />
        </Box>
    );
};

export default PublicLayout;
