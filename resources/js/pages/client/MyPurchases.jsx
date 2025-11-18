import React from 'react';
import {
    Box,
    Heading,
    useColorModeValue,
    Grid,
    HStack,
    VStack,
    Text,
    Badge,
    Image,
    Button,
    Divider,
} from '@chakra-ui/react';
import { MapPin, Calendar, DollarSign, TrendingUp, Eye, FileText } from 'lucide-react';

const PurchaseCard = ({ purchase }) => {
    const bgColor = useColorModeValue('white', 'gray.800');
    const priceChange = purchase.currentValue - purchase.purchasePrice;
    const priceChangePercent = ((priceChange / purchase.purchasePrice) * 100).toFixed(2);

    return (
        <Box bg={bgColor} borderRadius="xl" shadow="sm" overflow="hidden">
            <Image
                src={purchase.image || 'https://via.placeholder.com/600x300'}
                alt={purchase.address}
                h="200px"
                w="100%"
                objectFit="cover"
            />
            <VStack p={6} align="start" spacing={4}>
                <HStack justify="space-between" w="100%">
                    <Badge colorScheme="green" fontSize="sm">
                        Owned
                    </Badge>
                    <Badge colorScheme={purchase.type === 'primary' ? 'blue' : 'purple'} fontSize="sm">
                        {purchase.type === 'primary' ? 'Primary Residence' : 'Investment'}
                    </Badge>
                </HStack>

                <Heading size="md">{purchase.address}</Heading>

                <HStack spacing={2} color="gray.600">
                    <MapPin size={16} />
                    <Text fontSize="sm">{purchase.location}</Text>
                </HStack>

                <Divider />

                <VStack align="start" spacing={3} w="100%">
                    <HStack justify="space-between" w="100%">
                        <HStack spacing={2}>
                            <Calendar size={16} />
                            <Text fontSize="sm" color="gray.600">
                                Purchase Date
                            </Text>
                        </HStack>
                        <Text fontSize="sm" fontWeight="semibold">
                            {purchase.purchaseDate}
                        </Text>
                    </HStack>

                    <HStack justify="space-between" w="100%">
                        <HStack spacing={2}>
                            <DollarSign size={16} />
                            <Text fontSize="sm" color="gray.600">
                                Purchase Price
                            </Text>
                        </HStack>
                        <Text fontSize="sm" fontWeight="bold" color="blue.600">
                            ${purchase.purchasePrice.toLocaleString()}
                        </Text>
                    </HStack>

                    <HStack justify="space-between" w="100%">
                        <HStack spacing={2}>
                            <TrendingUp size={16} />
                            <Text fontSize="sm" color="gray.600">
                                Current Value
                            </Text>
                        </HStack>
                        <VStack align="end" spacing={0}>
                            <Text fontSize="sm" fontWeight="bold" color="green.600">
                                ${purchase.currentValue.toLocaleString()}
                            </Text>
                            <Text fontSize="xs" color={priceChange >= 0 ? 'green.500' : 'red.500'}>
                                {priceChange >= 0 ? '+' : ''}${priceChange.toLocaleString()} (
                                {priceChangePercent}%)
                            </Text>
                        </VStack>
                    </HStack>

                    <HStack justify="space-between" w="100%">
                        <Text fontSize="sm" color="gray.600">
                            Realtor
                        </Text>
                        <Text fontSize="sm" fontWeight="semibold">
                            {purchase.realtor}
                        </Text>
                    </HStack>
                </VStack>

                <Divider />

                <HStack spacing={3} w="100%">
                    <Button size="sm" leftIcon={<Eye size={16} />} colorScheme="blue" flex={1}>
                        View Details
                    </Button>
                    <Button size="sm" leftIcon={<FileText size={16} />} variant="outline" flex={1}>
                        Documents
                    </Button>
                </HStack>
            </VStack>
        </Box>
    );
};

const MyPurchases = () => {
    const purchases = [
        {
            id: 1,
            address: '123 Main St, Unit 5B',
            location: 'Downtown, New York, NY',
            purchasePrice: 450000,
            currentValue: 475000,
            purchaseDate: '2024-03-15',
            realtor: 'Sarah Johnson',
            type: 'primary',
            image: null,
        },
        {
            id: 2,
            address: '789 Pine Rd',
            location: 'Lakeside, New York, NY',
            purchasePrice: 425000,
            currentValue: 445000,
            purchaseDate: '2023-11-20',
            realtor: 'Sarah Johnson',
            type: 'investment',
            image: null,
        },
    ];

    const totalInvestment = purchases.reduce((sum, p) => sum + p.purchasePrice, 0);
    const totalCurrentValue = purchases.reduce((sum, p) => sum + p.currentValue, 0);
    const totalGain = totalCurrentValue - totalInvestment;
    const totalGainPercent = ((totalGain / totalInvestment) * 100).toFixed(2);

    return (
        <Box>
            <Heading mb={8}>My Purchases</Heading>

            <VStack spacing={6} align="stretch">
                {/* Summary Stats */}
                <Grid templateColumns="repeat(auto-fit, minmax(200px, 1fr))" gap={6}>
                    <Box
                        bg={useColorModeValue('white', 'gray.800')}
                        p={6}
                        borderRadius="xl"
                        shadow="sm"
                    >
                        <Text fontSize="sm" color="gray.600" mb={2}>
                            Total Properties
                        </Text>
                        <Text fontSize="3xl" fontWeight="bold">
                            {purchases.length}
                        </Text>
                    </Box>
                    <Box
                        bg={useColorModeValue('white', 'gray.800')}
                        p={6}
                        borderRadius="xl"
                        shadow="sm"
                    >
                        <Text fontSize="sm" color="gray.600" mb={2}>
                            Total Investment
                        </Text>
                        <Text fontSize="3xl" fontWeight="bold" color="blue.600">
                            ${totalInvestment.toLocaleString()}
                        </Text>
                    </Box>
                    <Box
                        bg={useColorModeValue('white', 'gray.800')}
                        p={6}
                        borderRadius="xl"
                        shadow="sm"
                    >
                        <Text fontSize="sm" color="gray.600" mb={2}>
                            Current Value
                        </Text>
                        <Text fontSize="3xl" fontWeight="bold" color="green.600">
                            ${totalCurrentValue.toLocaleString()}
                        </Text>
                    </Box>
                    <Box
                        bg={useColorModeValue('white', 'gray.800')}
                        p={6}
                        borderRadius="xl"
                        shadow="sm"
                    >
                        <Text fontSize="sm" color="gray.600" mb={2}>
                            Total Gain
                        </Text>
                        <Text fontSize="3xl" fontWeight="bold" color="green.600">
                            +${totalGain.toLocaleString()}
                        </Text>
                        <Text fontSize="sm" color="green.500">
                            +{totalGainPercent}%
                        </Text>
                    </Box>
                </Grid>

                {/* Properties List */}
                <Grid templateColumns="repeat(auto-fit, minmax(400px, 1fr))" gap={6}>
                    {purchases.map((purchase) => (
                        <PurchaseCard key={purchase.id} purchase={purchase} />
                    ))}
                </Grid>
            </VStack>
        </Box>
    );
};

export default MyPurchases;
