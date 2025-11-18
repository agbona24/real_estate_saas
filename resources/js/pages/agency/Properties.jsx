import React from 'react';
import {
    Box,
    Button,
    Heading,
    Grid,
    useColorModeValue,
    HStack,
    Image,
    VStack,
    Text,
    Badge,
    IconButton,
    Select,
} from '@chakra-ui/react';
import { Plus, Edit, Trash2, Eye, MapPin, Bed, Bath, Maximize } from 'lucide-react';

const PropertyCard = ({ property }) => {
    const bgColor = useColorModeValue('white', 'gray.800');

    return (
        <Box bg={bgColor} borderRadius="xl" shadow="sm" overflow="hidden">
            <Box position="relative">
                <Image
                    src={property.image || 'https://via.placeholder.com/400x300'}
                    alt={property.title}
                    h="200px"
                    w="100%"
                    objectFit="cover"
                />
                <Badge
                    position="absolute"
                    top={4}
                    left={4}
                    colorScheme={
                        property.status === 'available'
                            ? 'green'
                            : property.status === 'sold'
                            ? 'red'
                            : 'yellow'
                    }
                >
                    {property.status}
                </Badge>
                <Badge position="absolute" top={4} right={4} colorScheme="blue">
                    {property.type}
                </Badge>
            </Box>
            <VStack p={5} align="start" spacing={3}>
                <Text fontSize="2xl" fontWeight="bold" color="blue.600">
                    ${property.price.toLocaleString()}
                </Text>
                <Heading size="sm" noOfLines={1}>
                    {property.title}
                </Heading>
                <HStack spacing={2} color="gray.600">
                    <MapPin size={16} />
                    <Text fontSize="sm" noOfLines={1}>
                        {property.location}
                    </Text>
                </HStack>
                <HStack spacing={4} fontSize="sm" color="gray.600">
                    <HStack spacing={1}>
                        <Bed size={16} />
                        <Text>{property.bedrooms} beds</Text>
                    </HStack>
                    <HStack spacing={1}>
                        <Bath size={16} />
                        <Text>{property.bathrooms} baths</Text>
                    </HStack>
                    <HStack spacing={1}>
                        <Maximize size={16} />
                        <Text>{property.sqft} sqft</Text>
                    </HStack>
                </HStack>
                <Text fontSize="sm" color="gray.500">
                    Listed by: {property.listedBy}
                </Text>
                <HStack spacing={2} w="100%">
                    <IconButton
                        icon={<Eye size={16} />}
                        size="sm"
                        colorScheme="blue"
                        variant="outline"
                        aria-label="View property"
                        flex={1}
                    />
                    <IconButton
                        icon={<Edit size={16} />}
                        size="sm"
                        colorScheme="green"
                        variant="outline"
                        aria-label="Edit property"
                        flex={1}
                    />
                    <IconButton
                        icon={<Trash2 size={16} />}
                        size="sm"
                        colorScheme="red"
                        variant="outline"
                        aria-label="Delete property"
                        flex={1}
                    />
                </HStack>
            </VStack>
        </Box>
    );
};

const Properties = () => {
    const properties = [
        {
            id: 1,
            title: 'Luxury Downtown Condo',
            price: 450000,
            location: '123 Main St, Downtown',
            type: 'Condo',
            bedrooms: 2,
            bathrooms: 2,
            sqft: 1200,
            status: 'available',
            listedBy: 'Sarah Johnson',
            image: null,
        },
        {
            id: 2,
            title: 'Suburban Family Home',
            price: 325000,
            location: '456 Oak Ave, Suburbs',
            type: 'House',
            bedrooms: 4,
            bathrooms: 3,
            sqft: 2400,
            status: 'available',
            listedBy: 'Michael Chen',
            image: null,
        },
        {
            id: 3,
            title: 'Lakeside Villa',
            price: 675000,
            location: '789 Pine Rd, Lakeside',
            type: 'Villa',
            bedrooms: 5,
            bathrooms: 4,
            sqft: 3500,
            status: 'pending',
            listedBy: 'Sarah Johnson',
            image: null,
        },
        {
            id: 4,
            title: 'Modern City Apartment',
            price: 520000,
            location: '321 Elm St, City Center',
            type: 'Apartment',
            bedrooms: 3,
            bathrooms: 2,
            sqft: 1800,
            status: 'sold',
            listedBy: 'David Kim',
            image: null,
        },
        {
            id: 5,
            title: 'Cozy Starter Home',
            price: 275000,
            location: '654 Maple Dr, East Side',
            type: 'House',
            bedrooms: 3,
            bathrooms: 2,
            sqft: 1500,
            status: 'available',
            listedBy: 'Jessica Martinez',
            image: null,
        },
        {
            id: 6,
            title: 'Penthouse Suite',
            price: 950000,
            location: '987 Tower Blvd, Financial District',
            type: 'Penthouse',
            bedrooms: 4,
            bathrooms: 3,
            sqft: 2800,
            status: 'available',
            listedBy: 'David Kim',
            image: null,
        },
    ];

    return (
        <Box>
            <HStack justify="space-between" mb={8}>
                <Heading>Properties</Heading>
                <HStack spacing={3}>
                    <Select placeholder="All types" w="150px">
                        <option value="house">House</option>
                        <option value="condo">Condo</option>
                        <option value="apartment">Apartment</option>
                        <option value="villa">Villa</option>
                        <option value="penthouse">Penthouse</option>
                    </Select>
                    <Select placeholder="All status" w="150px">
                        <option value="available">Available</option>
                        <option value="pending">Pending</option>
                        <option value="sold">Sold</option>
                    </Select>
                    <Button leftIcon={<Plus size={20} />} colorScheme="blue">
                        Add Property
                    </Button>
                </HStack>
            </HStack>

            <Grid templateColumns="repeat(auto-fill, minmax(350px, 1fr))" gap={6}>
                {properties.map((property) => (
                    <PropertyCard key={property.id} property={property} />
                ))}
            </Grid>
        </Box>
    );
};

export default Properties;
