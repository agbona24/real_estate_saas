import React from 'react';
import { Box, Flex, useColorModeValue } from '@chakra-ui/react';
import { Outlet } from 'react-router-dom';

const AuthLayout = () => {
    const bgColor = useColorModeValue('gray.50', 'gray.900');

    return (
        <Flex minH="100vh" align="center" justify="center" bg={bgColor}>
            <Box w="full" maxW="md" px={6}>
                <Outlet />
            </Box>
        </Flex>
    );
};

export default AuthLayout;
