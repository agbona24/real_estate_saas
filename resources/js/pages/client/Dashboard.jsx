import React from 'react';
import {
    Box,
    Grid,
    useColorModeValue,
    Heading,
    HStack,
    VStack,
    Text,
    Badge,
    Icon,
    Button,
    Image,
} from '@chakra-ui/react';
import { Home, FileText, DollarSign, Calendar, MapPin, Eye } from 'lucide-react';

const InfoCard = ({ label, value, icon, color }) => {
    const bgColor = useColorModeValue('white', 'gray.800');

    return (
        <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
            <HStack spacing={4}>
                <Box p={3} bg={`${color}.50`} borderRadius="lg">
                    <Icon as={icon} color={`${color}.600`} fontSize="24px" />
                </Box>
                <VStack align="start" spacing={0}>
                    <Text fontSize="sm" color="gray.600">
                        {label}
                    </Text>
                    <Text fontSize="2xl" fontWeight="bold">
                        {value}
                    </Text>
                </VStack>
            </HStack>
        </Box>
    );
};

const PropertyCard = ({ property }) => {
    const bgColor = useColorModeValue('white', 'gray.800');

    return (
        <Box bg={bgColor} borderRadius="xl" shadow="sm" overflow="hidden">
            <Image
                src={property.image || 'https://via.placeholder.com/400x200'}
                alt={property.address}
                h="150px"
                w="100%"
                objectFit="cover"
            />
            <VStack p={5} align="start" spacing={3}>
                <HStack justify="space-between" w="100%">
                    <Badge colorScheme="green">Owned</Badge>
                    <Text fontWeight="bold" color="blue.600">
                        ${property.purchasePrice.toLocaleString()}
                    </Text>
                </HStack>
                <Heading size="sm">{property.address}</Heading>
                <HStack spacing={2} color="gray.600">
                    <MapPin size={16} />
                    <Text fontSize="sm">{property.location}</Text>
                </HStack>
                <VStack align="start" spacing={1} w="100%" fontSize="sm">
                    <HStack justify="space-between" w="100%">
                        <Text color="gray.500">Purchase Date:</Text>
                        <Text fontWeight="semibold">{property.purchaseDate}</Text>
                    </HStack>
                    <HStack justify="space-between" w="100%">
                        <Text color="gray.500">Current Value:</Text>
                        <Text fontWeight="semibold" color="green.600">
                            ${property.currentValue.toLocaleString()}
                        </Text>
                    </HStack>
                </VStack>
                <Button size="sm" leftIcon={<Eye size={16} />} colorScheme="blue" variant="outline" w="100%">
                    View Details
                </Button>
            </VStack>
        </Box>
    );
};

const ClientDashboard = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    const stats = [
        { label: 'Properties Owned', value: '2', icon: Home, color: 'blue' },
        { label: 'Total Investment', value: '$875K', icon: DollarSign, color: 'green' },
        { label: 'Documents', value: '12', icon: FileText, color: 'purple' },
        { label: 'Next Payment', value: 'Dec 1', icon: Calendar, color: 'orange' },
    ];

    const properties = [
        {
            id: 1,
            address: '123 Main St',
            location: 'Downtown, NY',
            purchasePrice: 450000,
            currentValue: 475000,
            purchaseDate: '2024-03-15',
            image: null,
        },
        {
            id: 2,
            address: '789 Pine Rd',
            location: 'Lakeside, NY',
            purchasePrice: 425000,
            currentValue: 445000,
            purchaseDate: '2023-11-20',
            image: null,
        },
    ];

    const recentActivity = [
        {
            id: 1,
            type: 'payment',
            title: 'Payment Processed',
            description: 'Monthly mortgage payment - $2,450',
            date: '2025-11-15',
            status: 'completed',
        },
        {
            id: 2,
            type: 'document',
            title: 'New Document',
            description: 'Property tax statement uploaded',
            date: '2025-11-10',
            status: 'new',
        },
        {
            id: 3,
            type: 'maintenance',
            title: 'Maintenance Request',
            description: 'HVAC inspection scheduled',
            date: '2025-11-08',
            status: 'scheduled',
        },
        {
            id: 4,
            type: 'update',
            title: 'Property Value Update',
            description: 'Market value increased by 5%',
            date: '2025-11-01',
            status: 'info',
        },
    ];

    return (
        <Box>
            <Heading mb={2}>Welcome Back!</Heading>
            <Text color="gray.600" mb={8}>
                Here's an overview of your real estate portfolio
            </Text>

            <VStack spacing={6} align="stretch">
                {/* Stats */}
                <Grid templateColumns="repeat(auto-fit, minmax(200px, 1fr))" gap={6}>
                    {stats.map((stat, index) => (
                        <InfoCard key={index} {...stat} />
                    ))}
                </Grid>

                {/* My Properties */}
                <Box>
                    <Heading size="md" mb={4}>
                        My Properties
                    </Heading>
                    <Grid templateColumns="repeat(auto-fit, minmax(300px, 1fr))" gap={6}>
                        {properties.map((property) => (
                            <PropertyCard key={property.id} property={property} />
                        ))}
                    </Grid>
                </Box>

                {/* Recent Activity */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Recent Activity
                    </Heading>
                    <VStack spacing={4} align="stretch">
                        {recentActivity.map((activity) => (
                            <Box
                                key={activity.id}
                                p={4}
                                borderRadius="lg"
                                bg="gray.50"
                                _dark={{ bg: 'gray.700' }}
                            >
                                <HStack justify="space-between" mb={2}>
                                    <Text fontWeight="semibold">{activity.title}</Text>
                                    <Badge
                                        colorScheme={
                                            activity.status === 'completed'
                                                ? 'green'
                                                : activity.status === 'new'
                                                ? 'blue'
                                                : activity.status === 'scheduled'
                                                ? 'orange'
                                                : 'gray'
                                        }
                                    >
                                        {activity.status}
                                    </Badge>
                                </HStack>
                                <Text fontSize="sm" color="gray.600" mb={1}>
                                    {activity.description}
                                </Text>
                                <Text fontSize="xs" color="gray.500">
                                    {activity.date}
                                </Text>
                            </Box>
                        ))}
                    </VStack>
                </Box>
            </VStack>
        </Box>
    );
};

export default ClientDashboard;
