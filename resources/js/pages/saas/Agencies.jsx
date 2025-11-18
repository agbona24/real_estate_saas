import React from 'react';
import {
    Box,
    Button,
    Heading,
    Table,
    Thead,
    Tbody,
    Tr,
    Th,
    Td,
    Badge,
    useColorModeValue,
    HStack,
    IconButton,
    Icon,
} from '@chakra-ui/react';
import { Plus, Edit2, Eye } from 'lucide-react';

const Agencies = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    const agencies = [
        { id: 1, name: 'Prime Realty', email: 'contact@primerealty.com', plan: 'Professional', status: 'active', realtors: 12 },
        { id: 2, name: 'Urban Estates', email: 'info@urbanestates.com', plan: 'Enterprise', status: 'active', realtors: 25 },
        { id: 3, name: 'Coastal Properties', email: 'hello@coastal.com', plan: 'Basic', status: 'trial', realtors: 5 },
        { id: 4, name: 'Metro Housing', email: 'support@metrohousing.com', plan: 'Professional', status: 'active', realtors: 18 },
        { id: 5, name: 'Summit Realty', email: 'info@summit.com', plan: 'Basic', status: 'inactive', realtors: 3 },
    ];

    return (
        <Box>
            <HStack justify="space-between" mb={8}>
                <Heading>Agencies</Heading>
                <Button leftIcon={<Icon as={Plus} />} colorScheme="brand">
                    Add Agency
                </Button>
            </HStack>

            <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                <Table variant="simple">
                    <Thead>
                        <Tr>
                            <Th>Agency Name</Th>
                            <Th>Email</Th>
                            <Th>Plan</Th>
                            <Th>Realtors</Th>
                            <Th>Status</Th>
                            <Th>Actions</Th>
                        </Tr>
                    </Thead>
                    <Tbody>
                        {agencies.map((agency) => (
                            <Tr key={agency.id}>
                                <Td fontWeight="semibold">{agency.name}</Td>
                                <Td>{agency.email}</Td>
                                <Td>{agency.plan}</Td>
                                <Td>{agency.realtors}</Td>
                                <Td>
                                    <Badge
                                        colorScheme={
                                            agency.status === 'active'
                                                ? 'green'
                                                : agency.status === 'trial'
                                                ? 'blue'
                                                : 'red'
                                        }
                                    >
                                        {agency.status}
                                    </Badge>
                                </Td>
                                <Td>
                                    <HStack spacing={2}>
                                        <IconButton
                                            icon={<Icon as={Eye} />}
                                            size="sm"
                                            variant="ghost"
                                            aria-label="View"
                                        />
                                        <IconButton
                                            icon={<Icon as={Edit2} />}
                                            size="sm"
                                            variant="ghost"
                                            aria-label="Edit"
                                        />
                                    </HStack>
                                </Td>
                            </Tr>
                        ))}
                    </Tbody>
                </Table>
            </Box>
        </Box>
    );
};

export default Agencies;
