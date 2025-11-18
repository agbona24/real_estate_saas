import React from 'react';
import {
    Box,
    Flex,
    IconButton,
    useColorModeValue,
    HStack,
    Menu,
    MenuButton,
    MenuList,
    MenuItem,
    MenuDivider,
    Avatar,
    Text,
    Badge,
    Icon,
} from '@chakra-ui/react';
import { Outlet, useNavigate } from 'react-router-dom';
import { Bell, LogOut, Settings, User } from 'lucide-react';
import Sidebar from '../components/Sidebar';
import { useAuthStore } from '../stores/authStore';

const DashboardLayout = () => {
    const { user, logout } = useAuthStore();
    const navigate = useNavigate();

    const bgColor = useColorModeValue('gray.50', 'gray.900');
    const headerBg = useColorModeValue('white', 'gray.800');
    const borderColor = useColorModeValue('gray.200', 'gray.700');

    const handleLogout = () => {
        logout();
        navigate('/login');
    };

    return (
        <Flex h="100vh" overflow="hidden">
            {/* Sidebar */}
            <Sidebar />

            {/* Main Content */}
            <Box flex="1" ml="280px" bg={bgColor}>
                {/* Header */}
                <Flex
                    as="header"
                    h="70px"
                    px={8}
                    align="center"
                    justify="space-between"
                    bg={headerBg}
                    borderBottom="1px"
                    borderColor={borderColor}
                    position="sticky"
                    top={0}
                    zIndex={10}
                >
                    <Box>
                        <Text fontSize="2xl" fontWeight="bold">
                            Welcome back, {user?.first_name}!
                        </Text>
                    </Box>

                    <HStack spacing={4}>
                        {/* Notifications */}
                        <IconButton
                            icon={<Icon as={Bell} />}
                            variant="ghost"
                            aria-label="Notifications"
                            position="relative"
                        >
                            <Badge
                                position="absolute"
                                top="8px"
                                right="8px"
                                colorScheme="red"
                                borderRadius="full"
                                fontSize="9px"
                                w="16px"
                                h="16px"
                                display="flex"
                                alignItems="center"
                                justifyContent="center"
                            >
                                3
                            </Badge>
                        </IconButton>

                        {/* User Menu */}
                        <Menu>
                            <MenuButton>
                                <HStack spacing={3} cursor="pointer">
                                    <Avatar
                                        size="sm"
                                        name={user?.first_name + ' ' + user?.last_name}
                                    />
                                </HStack>
                            </MenuButton>
                            <MenuList>
                                <MenuItem icon={<Icon as={User} />}>Profile</MenuItem>
                                <MenuItem icon={<Icon as={Settings} />}>Settings</MenuItem>
                                <MenuDivider />
                                <MenuItem
                                    icon={<Icon as={LogOut} />}
                                    onClick={handleLogout}
                                    color="red.500"
                                >
                                    Logout
                                </MenuItem>
                            </MenuList>
                        </Menu>
                    </HStack>
                </Flex>

                {/* Page Content */}
                <Box p={8} h="calc(100vh - 70px)" overflowY="auto">
                    <Outlet />
                </Box>
            </Box>
        </Flex>
    );
};

export default DashboardLayout;
