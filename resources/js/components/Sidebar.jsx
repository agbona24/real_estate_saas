import React, { useState } from 'react';
import {
    Box,
    Flex,
    Text,
    VStack,
    Icon,
    Collapse,
    useColorModeValue,
    Avatar,
    HStack,
    Badge,
} from '@chakra-ui/react';
import { NavLink, useLocation } from 'react-router-dom';
import {
    LayoutDashboard,
    Building2,
    Users,
    UserCog,
    CreditCard,
    Palette,
    Settings,
    Home,
    UserPlus,
    FileText,
    DollarSign,
    MapPin,
    GitBranch,
    Globe,
    BarChart3,
    PhoneCall,
    Package,
    ShoppingBag,
    MessageSquare,
    ChevronDown,
    ChevronRight,
} from 'lucide-react';
import { useAuthStore } from '../stores/authStore';

// Navigation items for each role
const navigationItems = {
    super_admin: [
        {
            name: 'Dashboard',
            icon: LayoutDashboard,
            path: '/dashboard',
        },
        {
            name: 'Agencies',
            icon: Building2,
            path: '/dashboard/agencies',
        },
        {
            name: 'Subscription Plans',
            icon: CreditCard,
            path: '/dashboard/subscription-plans',
        },
        {
            name: 'Themes',
            icon: Palette,
            path: '/dashboard/themes',
        },
        {
            name: 'Settings',
            icon: Settings,
            path: '/dashboard/settings',
        },
    ],
    agency_admin: [
        {
            name: 'Dashboard',
            icon: LayoutDashboard,
            path: '/dashboard/agency',
        },
        {
            name: 'CRM',
            icon: Users,
            children: [
                {
                    name: 'Leads',
                    icon: UserPlus,
                    path: '/dashboard/agency/leads',
                },
                {
                    name: 'Clients',
                    icon: Users,
                    path: '/dashboard/agency/clients',
                },
            ],
        },
        {
            name: 'Properties',
            icon: Home,
            path: '/dashboard/agency/properties',
        },
        {
            name: 'Transactions',
            icon: DollarSign,
            path: '/dashboard/agency/transactions',
        },
        {
            name: 'Team',
            icon: UserCog,
            children: [
                {
                    name: 'Realtors',
                    icon: UserCog,
                    path: '/dashboard/agency/realtors',
                },
                {
                    name: 'Branches',
                    icon: GitBranch,
                    path: '/dashboard/agency/branches',
                },
            ],
        },
        {
            name: 'Documents',
            icon: FileText,
            path: '/dashboard/agency/documents',
        },
        {
            name: 'Website',
            icon: Globe,
            path: '/dashboard/agency/website',
        },
        {
            name: 'Payments',
            icon: CreditCard,
            path: '/dashboard/agency/payments',
        },
        {
            name: 'Reports',
            icon: BarChart3,
            path: '/dashboard/agency/reports',
        },
        {
            name: 'Settings',
            icon: Settings,
            path: '/dashboard/agency/settings',
        },
    ],
    realtor: [
        {
            name: 'Dashboard',
            icon: LayoutDashboard,
            path: '/dashboard/realtor',
        },
        {
            name: 'My Leads',
            icon: UserPlus,
            path: '/dashboard/realtor/leads',
        },
        {
            name: 'My Clients',
            icon: Users,
            path: '/dashboard/realtor/clients',
        },
        {
            name: 'My Properties',
            icon: Home,
            path: '/dashboard/realtor/properties',
        },
        {
            name: 'Commissions',
            icon: DollarSign,
            path: '/dashboard/realtor/commissions',
        },
        {
            name: 'Documents',
            icon: FileText,
            path: '/dashboard/realtor/documents',
        },
    ],
    client: [
        {
            name: 'Dashboard',
            icon: LayoutDashboard,
            path: '/dashboard/client',
        },
        {
            name: 'My Properties',
            icon: Home,
            path: '/dashboard/client/purchases',
        },
        {
            name: 'Documents',
            icon: FileText,
            path: '/dashboard/client/documents',
        },
        {
            name: 'Payments',
            icon: CreditCard,
            path: '/dashboard/client/payments',
        },
        {
            name: 'Support',
            icon: MessageSquare,
            path: '/dashboard/client/support',
        },
    ],
};

const NavItem = ({ item, isActive, depth = 0 }) => {
    const [isOpen, setIsOpen] = useState(false);
    const location = useLocation();

    const hasChildren = item.children && item.children.length > 0;

    const bgColor = useColorModeValue('white', 'gray.800');
    const hoverBg = useColorModeValue('gray.50', 'gray.700');
    const activeBg = useColorModeValue('brand.50', 'brand.900');
    const activeColor = useColorModeValue('brand.600', 'brand.200');
    const textColor = useColorModeValue('gray.700', 'gray.200');

    const isChildActive = hasChildren && item.children.some(
        (child) => location.pathname === child.path
    );

    const NavContent = () => (
        <Flex
            align="center"
            px={4}
            py={3}
            mx={2}
            borderRadius="lg"
            cursor="pointer"
            bg={isActive || isChildActive ? activeBg : 'transparent'}
            color={isActive || isChildActive ? activeColor : textColor}
            _hover={{ bg: hoverBg }}
            transition="all 0.2s"
            onClick={() => hasChildren && setIsOpen(!isOpen)}
            pl={depth > 0 ? 8 : 4}
        >
            <Icon as={item.icon} fontSize="20" mr={3} />
            <Text fontWeight={isActive ? 'semibold' : 'medium'} flex="1" fontSize="sm">
                {item.name}
            </Text>
            {hasChildren && (
                <Icon
                    as={isOpen ? ChevronDown : ChevronRight}
                    fontSize="16"
                    transition="all 0.2s"
                />
            )}
        </Flex>
    );

    if (hasChildren) {
        return (
            <Box>
                <NavContent />
                <Collapse in={isOpen} animateOpacity>
                    <VStack spacing={0} align="stretch" mt={1}>
                        {item.children.map((child) => (
                            <NavItem
                                key={child.path}
                                item={child}
                                isActive={location.pathname === child.path}
                                depth={depth + 1}
                            />
                        ))}
                    </VStack>
                </Collapse>
            </Box>
        );
    }

    return (
        <NavLink to={item.path}>
            <NavContent />
        </NavLink>
    );
};

const Sidebar = () => {
    const { user } = useAuthStore();
    const location = useLocation();

    const bgColor = useColorModeValue('white', 'gray.800');
    const borderColor = useColorModeValue('gray.200', 'gray.700');

    const userNavigation = navigationItems[user?.role] || [];

    return (
        <Box
            as="aside"
            w="280px"
            h="100vh"
            bg={bgColor}
            borderRight="1px"
            borderColor={borderColor}
            position="fixed"
            left={0}
            top={0}
            overflowY="auto"
            css={{
                '&::-webkit-scrollbar': {
                    width: '4px',
                },
                '&::-webkit-scrollbar-track': {
                    width: '6px',
                },
                '&::-webkit-scrollbar-thumb': {
                    background: 'gray',
                    borderRadius: '24px',
                },
            }}
        >
            {/* Logo */}
            <Flex align="center" px={6} py={6} borderBottom="1px" borderColor={borderColor}>
                <Box>
                    <Text fontSize="xl" fontWeight="bold" color="brand.600">
                        RealEstate SaaS
                    </Text>
                    <Text fontSize="xs" color="gray.500">
                        {user?.role?.replace('_', ' ').toUpperCase()}
                    </Text>
                </Box>
            </Flex>

            {/* User Profile */}
            <Flex align="center" px={4} py={4} borderBottom="1px" borderColor={borderColor}>
                <Avatar size="sm" name={user?.first_name + ' ' + user?.last_name} mr={3} />
                <Box flex="1" overflow="hidden">
                    <Text fontSize="sm" fontWeight="semibold" noOfLines={1}>
                        {user?.first_name} {user?.last_name}
                    </Text>
                    <Text fontSize="xs" color="gray.500" noOfLines={1}>
                        {user?.email}
                    </Text>
                </Box>
            </Flex>

            {/* Navigation */}
            <VStack spacing={1} align="stretch" py={4}>
                {userNavigation.map((item) => (
                    <NavItem
                        key={item.path || item.name}
                        item={item}
                        isActive={location.pathname === item.path}
                    />
                ))}
            </VStack>
        </Box>
    );
};

export default Sidebar;
